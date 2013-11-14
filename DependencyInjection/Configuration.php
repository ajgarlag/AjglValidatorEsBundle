<?php
/**
 * This file is part of the AJ General Libraries Bundles
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Bundle\ValidatorEs\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ajgl_validator_es');

        $rootNode
            ->children()
                ->scalarNode('namespace_alias')
                    ->defaultValue('AjglEs')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('validator')
                    ->defaultValue('validator')
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
