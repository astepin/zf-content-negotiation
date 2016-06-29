<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ContentNegotiation\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZF\ContentNegotiation\ContentTypeFilterListener;

class ContentTypeFilterListenerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $listener = new ContentTypeFilterListener();

        /* @var $options \ZF\ContentNegotiation\ContentNegotiationOptions */
        $options = $container->get('ZF\ContentNegotiation\ContentNegotiationOptions');

        $listener->setConfig($options->getContentTypeWhitelist());

        return $listener;
    }
}
