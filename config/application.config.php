<?php
require_once 'database.config.php';
return array(
    'modules' => array(
        'ZendDeveloperTools',
        'DoctrineModule',
        'DoctrineORMModule',
        'OcraServiceManager',
        'BjyProfiler',
        'Application',
        'Manage',
        //'ZfcRbac',

    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php'
        ),
        'module_paths' => array(
            './module',
            './vendor',

        ),
    ),
);
