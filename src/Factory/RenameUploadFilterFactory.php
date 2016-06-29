<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ContentNegotiation\Factory;

use Interop\Container\ContainerInterface;
use Traversable;
use Zend\Filter\FilterPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZF\ContentNegotiation\Filter\RenameUpload;

class RenameUploadFilterFactory implements FactoryInterface
{
    /**
     * @var null|array|Traversable
     */
    protected $creationOptions;

    /**
     * @param null|array|Traversable $options
     */
    public function __construct($options = null)
    {
        $this->creationOptions = $options;
    }

    /**
     * @param array $options
     */
    public function setCreationOptions(array $options)
    {
        $this->creationOptions = $options;
    }

    /**
     * Create a RenameUpload instance
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return RenameUpload
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $filter   = new RenameUpload($this->creationOptions);
        if ($container->has('Request')) {
            $filter->setRequest($container->get('Request'));
        }

        return $filter;
    }
}
