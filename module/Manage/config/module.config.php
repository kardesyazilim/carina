<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Manage\Controller\Index' => 'Manage\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);
