<?php
/*
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => 'qweytr',
                    'dbname' => 'dinamo_master',
                ),
                'configuration' => array(
                'orm_default' => array(
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
            ),    
        ),

            ),
        ),
        

    ),
);*/
return array(
    'doctrine' => array(
        'connection' => array(
            'odm_default' => array(
                'server'    => 'localhost',
                'port'      => '3306',
                'dbname'    => 'dinamo_master',
                'options'   => array()
            ),
        ),
        'configuration' => array(
            'odm_default' => array(
                'metadata_cache'     => 'array',
                'driver'             => 'odm_default',
                'generate_proxies'   => true,
                'proxy_dir'          => 'data/DoctrineMongoODMModule/Proxy',
                'proxy_namespace'    => 'DoctrineMongoODMModule\Proxy',
                'generate_hydrators' => true,
                'hydrator_dir'       => 'data/DoctrineMongoODMModule/Hydrator',
                'hydrator_namespace' => 'DoctrineMongoODMModule\Hydrator',
                'default_db'         => 'zf2odm',
                'filters'            => array()
            )
        ),
        'driver' => array(
            'odm_default' => array(
                'drivers' => array(
                    'Application\Document' => 'aplikasi'
                )
            ),
            'aplikasi' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    'module/Application/src/Application/Document'
                )
            )
        ),
        'documentmanager' => array(
            'odm_default' => array(
                'connection'    => 'odm_default',
                'configuration' => 'odm_default',
                'eventmanager' => 'odm_default'
            )
        ),
        'eventmanager' => array(
            'odm_default' => array(
                'subscribers' => array()
            )
        ),
    ),
);
