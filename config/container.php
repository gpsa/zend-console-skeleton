<?php
/*
 * Script criado em 23/10/2018.
 */

use Zend\ServiceManager\ServiceManager;

$config = include 'config/config.php';
$container = new ServiceManager($config['service_manager']);

// Application and configuration
$container->setService('config', $config);

return $container;
