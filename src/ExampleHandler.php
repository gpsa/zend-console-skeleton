<?php

namespace ZendConsoleSkeleton;

use Interop\Container\ContainerInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\ColorInterface;
use ZF\Console\Route;

/**
 * This class is an example of a CLI command handler
 * Class ExampleHandler
 * @package ZendConsoleSkeleton
 */
class ExampleHandler
{

    public function __invoke(Route $route, Console $console)
    {
        $console->writeLine("The " . __METHOD__ . " method was used as a handler.");
    }

    public function callback(Route $route, Console $console)
    {
        $console->writeLine("The callback method was used as a handler.");
    }

    public function cacheConfigStatus(Route $route, Console $console)
    {
        if (empty(glob('data/cache/*.php'))) {
            $msg = "Nenhum arquivo de cache configurado";
            $color = ColorInterface::LIGHT_GREEN;

        } else {
            $msg = "ARQUIVO de cache existente!";
            $color = ColorInterface::LIGHT_YELLOW;
        }

        $console->writeLine($msg, $color);
    }
}
