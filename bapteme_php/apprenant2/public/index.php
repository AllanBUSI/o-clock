<?php
session_start();

use App\Controllers\MainController;
use App\Controllers\TeachersController;
use App\Controllers\StudentsController;

require_once '../vendor/autoload.php';


$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
} else { // sinon
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => MainController::class
    ],
    'main-home'
);

$router->map(
    'GET',
    '/teachers',
    [
        'method' => 'list',
        'controller' => TeachersController::class
    ],
    'teachers-list'
);

$router->map(
    'GET',
    '/students',
    [
        'method' => 'list',
        'controller' => StudentsController::class
    ],
    'students-list'
);

$router->map(
    'GET',
    '/teachers/add',
    [
        'method' => 'add',
        'controller' => TeachersController::class
    ],
    'teachers-add'
);




// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();
// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();