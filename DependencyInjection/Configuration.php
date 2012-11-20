<?php

namespace Neo4j\OGM\OGMBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('neo4j_ogm');

        $rootNode
            ->children()
                ->scalarNode('transport')->end()
                ->scalarNode('host')->end()
                ->scalarNode('port')->end()
                ->scalarNode('debug')->end()
                ->scalarNode('username')->end()
                ->scalarNode('password')->end()
                ->scalarNode('proxy_dir')->end()
                ->scalarNode('annotation_reader')->end()
            ->end();

        return $treeBuilder;
    }
}
