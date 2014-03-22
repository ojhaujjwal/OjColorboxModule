<?php
namespace OjColorboxModule;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;

class Module implements
    BootstrapListenerInterface,
    ConfigProviderInterface,
    AutoloaderProviderInterface,
    ControllerPluginProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $e->attachAggregate($serviceManager->get('OjColorboxModule\View\Strategy\ColorboxStrategy'));
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getControllerPluginConfig()
    {
        return [
            'invokables' => [
                'OjColorboxModule\Controller\Plugin\ColorboxClose'
                    => 'OjColorboxModule\Controller\Plugin\ColorboxClose',
                'OjColorboxModule\Controller\Plugin\ParentRedirect'
                    => 'OjColorboxModule\Controller\Plugin\ParentRedirect',
            ],
            'aliases' => [
                'colorboxClose'     => 'OjColorboxModule\Controller\Plugin\ColorboxClose',
                'ParentRedirect'    => 'OjColorboxModule\Controller\Plugin\ParentRedirect',
            ]
        ];
    }
}
