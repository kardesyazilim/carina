<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Container;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $serviceManager = $e->getApplication()->getServiceManager();
        $this->bootstrapSession($e);
        //$eventManager->attach(
        //    $serviceManager->get('ZfcRbac\View\Strategy\UnauthorizedStrategy')
        //);
        //$this->bootstrapDb($e);
        //$eventManager->attach('render', array($this, 'setLayoutTitle'));
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() 
    {
        return array(

            'Zend\Loader\ClassMapAutoloader' => array(
            
                __DIR__ . '/autoload_classmap.php',
            
            ),
            'Zend\Loader\StandardAutoloader' => array(
            
                'namespaces' => array(
            
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
            
                ),
            
            ),
        );
    }

    public function bootstrapSession($e)
    {
        $session = $e->getApplication()
                     ->getServiceManager()
                     ->get('Zend\Session\SessionManager');
        $session->start();

        $container = new Container('initialized');
        if (!isset($container->init)) {
             $session->regenerateId(true);
             $container->init = 1;
        }
    }

    public function getServiceConfig()
    {
         return array(
            'factories' => array(
                'Zend\Session\SessionManager' => function ($sm) {
                    $config = $sm->get('config');
                    if (isset($config['session'])) {
                        $session = $config['session'];

                        $sessionConfig = null;
                        if (isset($session['config'])) {
                            $class = isset($session['config']['class'])  ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                            $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                            $sessionConfig = new $class();
                            $sessionConfig->setOptions($options);
                        }

                        $sessionStorage = null;
                        if (isset($session['storage'])) {
                            $class = $session['storage'];
                            $sessionStorage = new $class();
                        }

                        $sessionSaveHandler = null;
                        if (isset($session['save_handler'])) {
                            // class should be fetched from service manager since it will require constructor arguments
                            $sessionSaveHandler = $sm->get($session['save_handler']);
                        }

                        $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

                        if (isset($session['validator'])) {
                            $chain = $sessionManager->getValidatorChain();
                            foreach ($session['validator'] as $validator) {
                                $validator = new $validator();
                                $chain->attach('session.validate', array($validator, 'isValid'));

                            }
                        }
                    } else {
                        $sessionManager = new SessionManager();
                    }
                    Container::setDefaultManager($sessionManager);
                    return $sessionManager;
                },
            ),
        );
    }



/*
    public function setLayoutTitle($e) {
      $matches    = $e->getRouteMatch();
      //$action     = $matches->getParam('url');
      //$controller = $matches->getParam('controller');
      //$module     = __NAMESPACE__;
      $siteName   = 'Dinamo Elektrik';

      // Getting the view helper manager from the application service manager
      $viewHelperManager = $e->getApplication()->getServiceManager()->get('viewHelperManager');

      // Getting the headTitle helper from the view helper manager
      $headTitleHelper   = $viewHelperManager->get('headTitle');

      // Setting a separator string for segments
      $headTitleHelper->setSeparator(' - ');

      // Setting the action, controller, module and site name as title segments
      //$headTitleHelper->append($action);
      //$headTitleHelper->append($controller);
      //$headTitleHelper->append($module);
      $headTitleHelper->append($siteName);
   
    }
    
    public function bootstrapDb(MvcEvent $e) {
        $e->getApplication()->getEventManager()->getSharedManager()
                ->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function ($e) {
                    $e->getApplication()->getServiceManager()->setAllowOverride(true);
                    $controller = $e->getTarget();
                    $controllerClass = get_class($controller);
                    $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

                    //$dbConfig = $e->getApplication()->getServiceManager()->get('config')['dbParams'];
                    $dbParams = array(
                        'database' => 'localhost',
                        'username' => 'changeme',
                        'password' => 'changeme',
                        'hostname' => 'localhost',
                        // buffer_results - only for mysqli buffered queries, skip for others
                        'options' => array('buffer_results' => true)
                    );

                    // Global Application config
                    $config = array_merge(
                            array_intersect_key(
                                    $dbConfig, array_flip(array('username', 'password', 'database', 'hostname', 'options'))
                            ), $dbConfig[strtolower($moduleNamespace)]
                    );

                    $controller->getServiceLocator()->setFactory(
                            'Zend\Db\Adapter\Adapter', function ($sm) use ($config) {
                        $adapter = new \BjyProfiler\Db\Adapter\ProfilingAdapter($config);
                        $adapter->setProfiler(new \BjyProfiler\Db\Profiler\Profiler);
                        if (isset($config['options']) && is_array($config['options'])) {
                            $options = $config['options'];
                        } else {
                            $options = array();
                        }
                        $adapter->injectProfilingStatementPrototype($options);

                        return $adapter;
                    }
                    );
                }, 100);
    }
*/
}
