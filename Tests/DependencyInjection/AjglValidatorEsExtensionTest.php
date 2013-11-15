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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;
use Ajgl\Bundle\ValidatorEs\DependencyInjection\AjglValidatorEsExtension;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class AjglValidatorEsExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var AjglValidatorEsExtension
     */
    private $extension;

    protected function setUp()
    {
        parent::setUp();
        $this->container = new ContainerBuilder();
        $this->extension = new AjglValidatorEsExtension();
    }

    protected function defineValidatorService(ContainerBuilder $container)
    {
        $container->register('validator', 'stdClass');
    }

    public function testContainerDefinitionsAreIgnoredIfNoValidator()
    {
        $config = Yaml::parse($this->getBundleDefaultConfig());
        $this->assertNull(
            $this->extension->load($config, $this->container)
        );
    }

    public function testContainerDefinitionsAreIgnoredIfNoConfiguredValidator()
    {
        $config = Yaml::parse($this->getBundleConfig());
        $this->defineValidatorService($this->container);
        $this->extension->load($config, $this->container);

        $definition = $this->container->getDefinition('validator');
        $calls = $definition->getMethodCalls();
        $this->assertEmpty($calls);
    }

    public function testContainerExtensionWithDefaultValidator()
    {
        $config = Yaml::parse($this->getBundleDefaultConfig());
        $this->defineValidatorService($this->container);
        $this->extension->load($config, $this->container);

        $definition = $this->container->getDefinition('validator');
        foreach ($definition->getMethodCalls() as $call) {
            if ($call[0] == 'addNamespaceAlias'&& $call[1] == array('AjglEs', 'Ajgl\Validator\Es\Constraints')) {
                $this->assertTrue(true);

                return;
            }
        }

        $this->fail("Expected call definition not found.");
    }

    private function getBundleConfig()
    {
        return <<< 'EOF'
ajgl_validator_es:
    namespace_alias: "Es"
    validator: other_validator
EOF;
    }

    private function getBundleDefaultConfig()
    {
        return <<< 'EOF'
ajgl_validator_es:
    namespace_alias: "AjglEs"
    validator: validator
EOF;
    }

}
