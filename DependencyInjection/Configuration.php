<?php

namespace Avro\GeneratorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
* Contains the configuration information for the bundle
*
* @author Joris de Wit <joris.w.dewit@gmail.com>
*/
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('avro_generator');

        $rootNode
            ->children()
                ->scalarNode('style')->cannotBeEmpty()->end()
                ->booleanNode('overwrite')->defaultFalse()->end()
                ->booleanNode('add_fields')->defaultTrue()->end()
                ->booleanNode('use_owner')->defaultFalse()->end()
                ->arrayNode('files')
                    ->useAttributeAsKey('file')->prototype('array')
                        ->children()
                            ->scalarNode('filename')->end()
                            ->scalarNode('template')->end()
                            ->arrayNode('tags')
                                ->useAttributeAsKey('tag')->prototype('scalar')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('standalone_files')
                ->useAttributeAsKey('standalone_file')->prototype('array')
                        ->children()
                            ->scalarNode('filename')->end()
                            ->scalarNode('template')->end()
                            ->arrayNode('tags')
                                ->useAttributeAsKey('tag')->prototype('scalar')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('bundle_folders')
                    ->useAttributeAsKey('bundle_folder')->prototype('array')
                        ->children()
                            ->scalarNode('path')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('bundle_files')
                    ->useAttributeAsKey('bundle_file')->prototype('array')
                        ->children()
                            ->scalarNode('filename')->end()
                            ->scalarNode('template')->end()
                            ->arrayNode('tags')
                                ->useAttributeAsKey('tag')->prototype('scalar')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
             ->end();


        return $treeBuilder;
    }

}
