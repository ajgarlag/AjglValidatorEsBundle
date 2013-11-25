<?php
/**
 * This file is part of the AJ General Libraries Bundles
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Bundle\ValidatorEsBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class AjglValidatorEsExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);

        if (!$container->hasDefinition($config['validator'])) {
            return;
        }

        $definition = $container->getDefinition($config['validator']);
        $definition->addMethodCall(
            'addNamespaceAlias',
            array(
                (string) $config['namespace_alias'],
                'Ajgl\Validator\Es\Constraints'
            )
        );
    }
}
