<?php
session_start();

// POINT D'ENTRÉE UNIQUE :
// FrontController

// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)


use App\Controllers\StudentsController;
use App\Controllers\TeachersController;
use App\Controllers\MainController;
use App\Controllers\UserController;


require_once '../vendor/autoload.php';

/* ------------
--- ROUTAGE ---
-------------*/


// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va
$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
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
        'controller' => MainController::class // On indique le FQCN de la classe
    ],
    'main-home'
);



$router->map(
    'GET',
    '/teachers/list',
    [
        'method' => 'products',
        'controller' => TeachersController::class // On indique le FQCN de la classe
    ],
    'teachers'
);

$router->map(
    'GET',
    '/teachers/delete/[i:teachersid]',
    [
        'method' => 'teachersDelete',
        'controller' => TeachersController::class // On indique le FQCN de la classe
    ],
    'teachers_delete'
);


$router->map(
    'GET||POST',
    '/teachers/add',
    [
        'method' => 'teachersAdd',
        'controller' => TeachersController::class // On indique le FQCN de la classe
    ],
    'teachers_add'
);

/* La route permettant de faire :
    - l'affichage du formulaire de modification d'un produit
    - le traitement de ce formulaire pour éditer un produit
*/

$router->map(
    'GET||POST',
    '/teachers/update/[i:teachersid]',
    [
        'method' => 'teachersEdit',
        'controller' => TeachersController::class // On indique le FQCN de la classe
    ],
    'teachers_edit'
);

// ROUTES POUR LES ETUDIANTS

$router->map(
    'GET',
    '/students/list',
    [
        'method' => 'student',
        'controller' => StudentController::class // On indique le FQCN de la classe
    ],
    'students'
);

$router->map(
    'GET||POST',
    '/students/add',
    [
        'method' => 'studentsAdd',
        'controller' => StudentController::class // On indique le FQCN de la classe
    ],
    'students_add'
);

/* La route permettant de faire :
    - l'affichage du formulaire de modification d'une marque
    - le traitement de ce formulaire pour éditer une marque
*/

$router->map(
    'GET||POST',
    '/students/update/[i:studentid]',
    [
        'method' => 'studentsUpdate',
        'controller' => StudentsController::class // On indique le FQCN de la classe
    ],
    'Students_update'
);

/* La route qui va permettre de gérer le formulaire de connexion */

$router->map(
    'GET||POST',
    '/user/login',
    [
        'method' => 'login',
        'controller' => UserController::class // On indique le FQCN de la classe
    ],
    'user_login'
);

$router->map(
    'GET',
    '/user/logout',
    [
        'method' => 'logout',
        'controller' => UserController::class // On indique le FQCN de la classe
    ],
    'user_logout'
);
$router->map(
    'GET',
    '/user/list',
    [
        'method' => 'user',
        'controller' => UserController::class // On indique le FQCN de la classe
    ],
    'user_list'
);
$router->map(
    'GET||POST',
    '/user/add',
    [
        'method' => 'userAdd',
        'controller' => UserController::class 
    ],
    'user_add'
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
