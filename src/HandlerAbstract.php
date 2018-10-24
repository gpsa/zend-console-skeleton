<?php
/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 23/10/18
 * Time: 23:47
 */

namespace ZendConsoleSkeleton;

use Interop\Container\ContainerInterface;

abstract class HandlerAbstract
{
    /**
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * In this example the __invoke magic method is used to simplify the
     * configuration of the route. All that must be declared in the route
     * configuration is the class name
     * @param Route $route
     * @param Console $console
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     * @return HandlerAbstract
     */
    public function setContainer(ContainerInterface $container): HandlerAbstract
    {
        $this->container = $container;
        return $this;
    }


}