#!/usr/bin/env php
<?php

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) Slavey Karadzhov
 */
use Psr\Container\ContainerInterface;
use Zend\Console\Console;
use ZF\Console\Application;
use ZF\Console\Dispatcher;

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    throw new Exception(
    'Composer autoload script not found. Run \'composer install\''
    );
}

require_once __DIR__ . '/../vendor/autoload.php';

/* @var $container ContainerInterface */
$container = include __DIR__ . '/../config/container.php';

/**
 * You can inject a ServiceManager container into the dispatcher to use for
 * finding declared handlers
 */
$dispatcher = new Dispatcher($container);

$config = $container->get('config');

$application = new Application(
    $config['name'], $config['version'], include __DIR__ . '/../config/routes.php', Console::getInstance(), $dispatcher
);

$exit = $application->run();
exit($exit);
