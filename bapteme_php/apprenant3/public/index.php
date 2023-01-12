<?php

use App\Controllers\ErrorController;
use App\Controllers\MainController;
use App\Controllers\TeacherController;
use App\Controllers\StudentController;


require_once '../vendor/autoload.php';


/* ------------
--- ROUTAGE ---
-------------*/

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
    '/home',
    [
        'method' => 'home',
        'controller' => MainController::class // On indique le FQCN de la classe
    ],
    'main-home'
);

$router->map(
    'GET',
    '/teacher_list',
    [
        'method' => 'teachers',
        'controller' => TeacherController::class
    ],
    'teachers'
);

$router->map(
    'GET',
    '/students_list',
    [
        'method' => 'students',
        'controller' => StudentController::class
    ],
    'students'
);

$router->map(
    'GET||POST',
    '/student/add',
    [
        'method' => 'studentAdd',
        'controller' => StudentController::class // On indique le FQCN de la classe
    ],
    'student_add'
);

$router->map(
    'GET||POST',
    '/teacher/add',
    [
        'method' => 'teacherAdd',
        'controller' => TeacherController::class // On indique le FQCN de la classe
    ],
    'teacher_add'
);



/* -------------
--- DISPATCH ---
--------------*/

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();
// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();