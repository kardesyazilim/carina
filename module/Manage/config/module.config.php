<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Manage\Controller\Index' => 'Manage\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        /* 'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/manage/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'index/index' => __DIR__ .'/../view/manage/index/index.phtml',
        ),*/
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);
