<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cursos;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'cursos' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/cursos[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'listar',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Cursos' => __DIR__ . '/../view',
        ],
    ],
];
