<?php

namespace Product;

use Laminas\Router\Http\Segment;
use Product\Model\Product;
use Product\Form\ProductFieldset;

return [
    'router' => [
        'routes' => [
            'product' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/product[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'product' => __DIR__ . '/../view',
        ],
    ],

    'form_elements' => [
        'factories' => [
            Product\Form\ProductFieldset::class => Product\Form\ProductFieldsetFactory::class,
        ],
    ],
];
