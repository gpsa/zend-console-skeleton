<?php

namespace ZendConsoleSkeleton;

use Zend\Console\Adapter\AdapterInterface as Console;
use ZF\Console\Route;

/**
 * This class is an example of a CLI command handler
 * Class ExampleHandler
 * @package ZendConsoleSkeleton
 */
class ExampleServiceManagerHandler extends HandlerAbstract
{

    public function __invoke(Route $route, Console $console)
    {
        // options should be indexed array
        $options = $route->getMatchedParam('options');
        $console->write('The first option is ' . $options[0] . "\n");

        // params should be assoc. array
        $params = $route->getMatchedParam('params', array());
        $action = $route->getMatchedParam('action', array());

        print_r([$params, $action, $options]);

        foreach ($params as $key => $value) {
            $console->write(sprintf("Param %s has value %s\n", $key, $value));
        }

        // and flag should be boolean
        if ($route->getMatchedParam('flag')) {
            $console->write("Flag was set.\n");
        }
    }
}
