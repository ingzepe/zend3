<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Catalogo;

use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\ControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'catalogo' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/catalogo[/:action][/:id]',
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
            'catalogo.paginator' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/catalogo/index/[page/:page]',
                    'defaults' => [
                        'page' => 1,
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ]
                ]
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Catalogo' => __DIR__ . '/../view',
        ],
    ],
];
