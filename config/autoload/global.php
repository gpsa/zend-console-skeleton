<?php

namespace ZendConsoleSkeleton;

/*
 * Script criado em 17/10/2018.
 */
if (file_exists(__DIR__ . '/../../composer.json')) {
    @$composer = json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true);
    if (isset($composer['version'])) {
        $version = $composer['version'];
    }
}

define('VERSION', $version);

return array(
    'name' => 'Zend Console Skeleton',
    'version' => VERSION,
    'service_manager' => [
        'invokables' => [
            'teste' => \stdClass::class
        ],
        'factories' => [
            ExampleServiceManagerHandler::class => HandlerFactory::class
        ]
    ]
);
