<?php

namespace App\Core;

use App\Controller\AuthController;
use App\Controller\InscriptionController;

class Router
{
    public function __construct()
    {
        $uri = parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );

        $routes = [

            '/afficherVue' => [
                'controller' => InscriptionController::class,
                'action' => 'afficherVue'
            ],

            '/connexion' => [
                'controller' => AuthController::class,
                'action' => 'connexion'
            ],

            '/saveEleves' => [
                'controller' => AuthController::class,
                'action' => 'saveEleves'
            ],

            '/saveTuteur' => [
                'controller' => AuthController::class,
                'action' => 'saveTuteur'
            ],

            '/saveJustification' => [
                'controller' => AuthController::class,
                'action' => 'saveJustification'
            ],

            '/validerInscription' => [
                'controller' => AuthController::class,
                'action' => 'validerInscription'
            ]
        ];

        if ($uri === '/') {
            $uri = '/afficherVue';
        }

        if (isset($routes[$uri])) {

            $route = $routes[$uri];

            $controller = $route['controller'];
            $action = $route['action'];

            $controller::$action();

        } else {

            http_response_code(404);
            echo "Route inexistante";
        }
    }
}