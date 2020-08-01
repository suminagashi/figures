<?php

namespace Suminagashi\FiguresBundle\Annotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class Watch
{
    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $lifecycle;


    /**
     * @return string
     */
    public function getLifecycle()
    {
        return $this->lifecycle;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

}

