<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ContentNegotiation\Factory;

use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\Plugin\AcceptableViewModelSelector;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZF\ContentNegotiation\AcceptListener;

class AcceptListenerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var $options \ZF\ContentNegotiation\ContentNegotiationOptions */
        $options = $container->get('ZF\ContentNegotiation\ContentNegotiationOptions');

        $selector = null;
        if ($container->has('ControllerPluginManager')) {
            $plugins = $container->get('ControllerPluginManager');
            if ($plugins->has('AcceptableViewModelSelector')) {
                $selector = $plugins->get('AcceptableViewModelSelector');
            }
        }

        if (null === $selector) {
            $selector = new AcceptableViewModelSelector();
        }

        return new AcceptListener($selector, $options->toArray());
    }
}
