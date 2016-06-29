<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ContentNegotiation\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZF\ContentNegotiation\Validator\UploadFile;

class UploadFileValidatorFactory implements FactoryInterface
{
    /**
     * @var null|array|\Traversable
     */
    protected $creationOptions;

    /**
     * @param null|array|\Traversable $options
     */
    public function __construct($options = null)
    {
        $this->creationOptions = $options;
    }

    /**
     * Create an UploadFile instance
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return UploadFile
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $validator = new UploadFile($this->creationOptions);
        if ($container->has('Request')) {
            $validator->setRequest($container->get('Request'));
        }
        return $validator;
    }
}
