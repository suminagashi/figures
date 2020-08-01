<?php

declare(strict_types=1);

namespace Suminagashi\FiguresBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

final class FiguresExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader->load('services.yaml');

        $this->addAnnotatedClassesToCompile(array(
              'Suminagashi\\FiguresBundle\\Entity\\Figures',
              'Suminagashi\\FiguresBundle\\Repository\\FigureRepository',
          ));
    }
}
