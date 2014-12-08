<?php

namespace Flowcode\ProjectBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FlowcodeProjectExtension extends Extension {

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $this->bindParameters($container, $this->getAlias(), $config);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }

    /**
     * Binds the params from config
     *
     * @param ContainerBuilder $container Containerbuilder
     * @param string           $name      Alias name
     * @param array            $config    Configuration Array
     */
    public function bindParameters(ContainerBuilder $container, $name, $config) {
        if (is_array($config) && empty($config[0])) {
            foreach ($config as $key => $value) {
                $this->bindParameters($container, $name . '.' . $key, $value);
            }
        } else {
            $container->setParameter($name, $config);
        }
    }

}
