<?php

namespace ZendConsoleSkeleton;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/*
 * Script criado em 23/10/2018.
 */

class HandlerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        if (!class_exists($requestedName)) {
            throw  new \InvalidArgumentException("{$requestedName} inexistente");
        }

        return new $requestedName($container);
    }
}
