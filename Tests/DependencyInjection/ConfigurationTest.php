<?php
/**
 * This file is part of the AJ General Libraries Bundles
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Bundle\ValidatorEs\Tests\DependencyInjection;

use Ajgl\Bundle\ValidatorEs\DependencyInjection\Configuration;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        parent::setUp();

        $this->configuration = new Configuration();
    }

    public function testDefaultConfiguration()
    {
        $builder = $this->configuration->getConfigTreeBuilder();
        $node = $builder->buildTree();
        $this->assertInstanceOf('Symfony\Component\Config\Definition\ArrayNode', $node);
        $children = $node->getChildren();

        $this->assertArrayHasKey('namespace_alias', $children);
        $this->assertInstanceOf('Symfony\Component\Config\Definition\ScalarNode', $children['namespace_alias']);
        $this->assertEquals('AjglEs', $children['namespace_alias']->getDefaultValue());

        $this->assertArrayHasKey('validator', $children);
        $this->assertInstanceOf('Symfony\Component\Config\Definition\ScalarNode', $children['validator']);
        $this->assertEquals('validator', $children['validator']->getDefaultValue());
    }
}
