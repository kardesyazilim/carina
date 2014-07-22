<?php
return array(
	'controllers' => array (
		'invokables' => array (
			'Application\Controller\Index' => 'Application\Controller\IndexController',
			),
		),
	'router' => array (
		'routes' => array (
			'application' => array (
				'type' => 'segment',
				'options' => array (
					'route' => '/application[/][:action][/:id]',
					'constraints' => array (
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
						),
					'defaults' => array (
						'controller' => 'Application\Controller\Index',
						'action' => 'index',
						),
					),
				),
			),
		),
	'view_manager' => array (
		'template_path_stack' => array(
			'application' => __DIR__ . '/../view',
			),
		),
);