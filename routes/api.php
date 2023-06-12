<?php 

require_once 'controller/PedidosController.php';
require_once 'controller/ClientesController.php';
require_once 'controller/ComercialesController.php';

$routes = [
    '/pedidos' => [
        'controller' => 'PedidosController',
        'method' => [
            'GET' => 'getAll'
        ]
    ],

    '/createPedido' => [
        'controller' => 'PedidosController',
        'method' => [
            'POST' => 'savePedido'
        ]
    ],

    '/fechas' => [
        'controller' => 'PedidosController',
        'method' => [
            'GET' => 'getFechas'
        ]
    ],

    '/createClient' => [
        'controller' => 'ClientesController',
        'method' => [
            'POST' => 'createCliente'
        ]
    ],

    '/clientes' => [
        'controller' => 'ClientesController',
        'method' => [
            'GET' => 'getAllClientes'
        ]
    ],

    '/comerciales' => [
        'controller' => 'ComercialesController',
        'method' => [
            'GET' => 'getAllComerciales'
        ]
    ],

    '/createComercial' => [
        'controller' => 'ComercialesController',
        'method' => [
            'POST' => 'saveComercial'
        ]
    ]
];

return $routes;