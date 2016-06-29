<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ContentNegotiation;

use Zend\Loader\StandardAutoloader;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\DispatchableInterface;

class Module
{
    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return [
            StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/',
                ],
            ],
        ];
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
    public function onBootstrap(MvcEvent $e)
    {
        $app      = $e->getApplication();
        $services = $app->getServiceManager();
        $em       = $app->getEventManager();

        $em->attach(MvcEvent::EVENT_ROUTE, $services->get(ContentTypeListener::class), -625);
        /** @var AcceptFilterListener $acceptFilterListener */
        $acceptFilterListener = $services->get(AcceptFilterListener::class);
        $acceptFilterListener->attach($em);
        /** @var ContentTypeFilterListener $contentTypeFilterListener */
        $contentTypeFilterListener = $services->get(ContentTypeFilterListener::class);
        $contentTypeFilterListener->attach($em);

        $sem = $em->getSharedManager();
        $sem->attach(
            DispatchableInterface::class,
            MvcEvent::EVENT_DISPATCH,
            $services->get(AcceptListener::class),
            -10
        );
    }
}
