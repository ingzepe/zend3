<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Usuarios;

use Zend\Router\Http\Segment;
use Usuarios\Controller\ControllerFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\ControllerFactory::class,
            Controller\LoginController::class => Controller\ControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'usuarios' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/usuarios[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'login' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/login[/:action]',
                    'defaults' => [
                        'controller'    => Controller\LoginController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Usuarios' => __DIR__ . '/../view',
        ],
    ],
];
