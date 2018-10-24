<?php

namespace ZendConsoleSkeleton;

use ZF\Console\Filter\Explode;
use ZF\Console\Filter\QueryString;

return [
    [
        /**
         * The name of the command. This is a top-level command
         */
        'name' => 'example-sm',
        /**
         * You should specify a valid PHP callback for the "handler" value. Here
         * the zend's service_manager is used
         */
        'handler' => ExampleServiceManagerHandler::class,
        /**
         * The route of the command. This defines any second-level commands and
         * route arguments
         */
        'route' => '<action> [--options=] [--params=] [--flag]',
        /**
         * The command description that is printed when `php bin/cli.php example`
         * is ran. This shows because there is a required route argument
         */
        'description' => "Testing access console command through ServiceManager",
        /**
         * The command description that is printed when `php bin/cli.php`
         * is ran
         */
        'short_description' => 'Short introduction in creating new commands',
        /**
         * Option descriptions are printed when `php bin/cli.php example` is
         * ran
         */
        'options_descriptions' => [
            '<action>' => 'The example action to perform',
            '--options' => 'Comma separated list of options',
            '--params' => 'Query string list of parameters',
            '--flag' => 'Optional flag with default value',
        ],
        /**
         * Default argument values
         */
        'defaults' => [
            'params' => ['options' => 'v'],
        ],
        /**
         * Filters are useful for transforming the incoming data to the format
         * that you want.
         */
        'filters' => [
            // The filter below translates string "x,y,z" to array("x","y","z")
            'options' => Explode::class,
            // The filter below translates string "x=one&y=two" to array("x"=>"one", "y" => "two")
            'params' => QueryString::class
        ]
    ],
    /**
     * You should specify a valid PHP callback for the "handler" value. Here
     * the handler's __invoke method is used
     */
    [
        'name' => 'example',
        'handler' => new ExampleHandler(),
        'route' => 'example',
        'description' => 'This command uses a __invoke method for the handler',
        'short_description' => 'This command uses a __invoke method for the handler',
        'options_descriptions' => [],
        'defaults' => [],
        'filters' => [],
    ],
    /**
     * This is an example of using a class method as a handler
     */
    [
        'name' => 'callback',
        'handler' => [
            new ExampleHandler(),
            'callback'
        ],
        'route' => 'example',
        'description' => 'This command uses a class method for the handler',
        'short_description' => 'This command uses a class method for the handler',
        'options_descriptions' => [],
        'defaults' => [],
        'filters' => [],
    ],
    /**
     * This is an example of using a class method as a handler
     */
    [
        'name' => 'cache:config:status',
        'handler' => [
            new ExampleHandler(),
            'cacheConfigStatus'
        ],
        'route' => 'cache:config:status',
        'description' => 'This command uses a class method for the handler',
        'short_description' => 'This command uses a class method for the handler',
        'options_descriptions' => [],
        'defaults' => [],
        'filters' => [],
    ],
];
