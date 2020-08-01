<?php

namespace Suminagashi\FiguresBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

use Suminagashi\FiguresBundle\Annotation\Watch;
use Suminagashi\FiguresBundle\Entity\Figure;

use Doctrine\Common\Persistence\ObjectManager;

class FiguresListener implements EventSubscriber
{

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->handle('create', $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->handle('update', $args);
    }

    private function handle(string $action, LifecycleEventArgs $args)
    {
        $this->annotationReader = new AnnotationReader;
        $this->listExtractors = [new ReflectionExtractor];
        $this->propertyInfo = new PropertyInfoExtractor(
            $this->listExtractors,
        );
        $namespace = "Suminagashi\FiguresBundle\Annotation\Watch";
        $class = get_class($args->getObject());
        $properties = $this->propertyInfo->getProperties($class);

        foreach($properties as $property)
        {
            $annotations[$property] = $this->annotationReader->getPropertyAnnotations(new \ReflectionProperty($class, $property));

            foreach ($annotations[$property] as $annotation) {
                if(get_class($annotation) === $namespace){
                    if($annotation->getLifecycle() !== $action){
                        continue;
                    }
                    $this->triggerStat($annotation, $args, $property);
                    continue;
                }
            }
        }

    }
    private function triggerStat($annotation, $args, $property)
    {
        $em = $args->getObjectManager();
        $entity = $args->getObject();
        $type = $annotation->getType();
        $propertyGetter = 'get'.ucfirst($property);
        $value = $type === 'cumul' ? $entity->$propertyGetter() : 1;

        $figure = new Figure();
        $figure->setValue($value);
        $figure->setKey($annotation->getKey());
        $figure->setCreatedAt();

        $em->persist($figure);
        $em->flush();
    }
}
