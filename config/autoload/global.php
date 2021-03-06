<?php
$dbParams = array(
    'database'  => 'carina_master',
    'username'  => 'root',
    'password'  => 'qweytr',
    'hostname'  => 'localhost',
    // buffer_results - only for mysqli buffered queries, skip for others
    'options' => array('buffer_results' => true)
);
return array(
    'ocra_service_manager' => array(
        // Turn this on to disable dependencies view in Zend Developer Tools
        'logged_service_manager' => true,
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
        $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
            'driver' => 'pdo',
            'dsn' => 'mysql:dbname=' . $dbParams['database'] . ';host=' . $dbParams['hostname'],
            'database' => $dbParams['database'],
            'username' => $dbParams['username'],
            'password' => $dbParams['password'],
            'hostname' => $dbParams['hostname'],
        ));

        if (php_sapi_name() == 'cli') {
            $logger = new Zend\Log\Logger();
            // write queries profiling info to stdout in CLI mode
            $writer = new Zend\Log\Writer\Stream('php://output');
            $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
            $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
        } else {
            $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
        }
        if (isset($dbParams['options']) && is_array($dbParams['options'])) {
            $options = $dbParams['options'];
        } else {
            $options = array();
        }
        $adapter->injectProfilingStatementPrototype($options);
        return $adapter;
    },
        ),
    ),
    'session' => array(
        'config' => array(
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name' => 'carina',
            ),
        ),
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => array(
            array(
                'Zend\Session\Validator\RemoteAddr',
                'Zend\Session\Validator\HttpUserAgent',
            ),
        ),
    ),
);
