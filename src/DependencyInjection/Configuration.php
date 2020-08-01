<?php

declare(strict_types=1);

namespace Suminagashi\FiguresBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('figures');
        $treeBuilder->getRootNode()->end();

        return $treeBuilder;
    }
}
