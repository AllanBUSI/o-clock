<?php
// Je lance la session
session_start();

use App\Controllers\MainController;
use App\Controllers\TeacherController;
use App\Controllers\StudentController;
use App\Controllers\UserController;
use App\Controllers\ErrorController;

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


/* -------------
--- ROUTES ---
--------------*/

// route pour la home
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => MainController::class 
    ],
    'main-home'
);

// route pour la liste des profs
$router->map(
    'GET',
    '/teachers',
    [
        'method' => 'teacher',
        'controller' => TeacherController::class 
    ],
    'teacher_list'
);

// route pour la liste des étudiants
$router->map(
    'GET',
    '/students/list',
    [
        'method' => 'student',
        'controller' => StudentController::class 
    ],
    'student_list'
);

// routes pour l'ajout des profs
$router->map(
    'GET',
    '/teachers/add',
    [
        'method' => 'teacherAddGet',
        'controller' => TeacherController::class 
    ],
    'teacher_add_get'
);

$router->map(
    'POST',
    '/teachers/add',
    [
        'method' => 'teacherAddPost',
        'controller' => TeacherController::class 
    ],
    'teacher_add_post'
);

// routes pour l'ajout des étudiants
$router->map(
    'GET',
    '/students/add',
    [
        'method' => 'studentAddGet',
        'controller' => StudentController::class 
    ],
    'student_add_get'
);

$router->map(
    'POST',
    '/students/add',
    [
        'method' => 'studentAddPost',
        'controller' => StudentController::class 
    ],
    'student_add_post'
);

// routes pour la page de connexion
$router->map(
    'GET',
    '/signin',
    [
        'method' => 'signinGet',
        'controller' => UserController::class 
    ],
    'signin_get'
);

$router->map(
    'POST',
    '/signin',
    [
        'method' => 'signinPost',
        'controller' => UserController::class 
    ],
    'signin_post'
);

// route pour se déconnecter
$router->map(
    'GET',
    '/logout',
    [
        'method' => 'logout',
        'controller' => UserController::class
    ],
    'user_logout'
);

// route 403
$router->map(
    'GET',
    '/403',
    [
        'method' => 'error403',
        'controller' => ErrorController::class
    ],
    'error403'
);

// route 404
$router->map(
    'GET',
    '/404',
    [
        'method' => 'error404',
        'controller' => ErrorController::class
    ],
    'error404'
);

// route pour supprimer un prof
$router->map(
    'GET',
    '/teacher/[i:teacherid]/delete',
    [
        'method' => 'teacherDelete',
        'controller' => TeacherController::class
    ],
    'teacher_delete'
);

// route pour supprimer un étudiant
$router->map(
    'GET',
    '/student/[i:studentid]/delete',
    [
        'method' => 'studentDelete',
        'controller' => StudentController::class
    ],
    'student_delete'
);

// routes pour modifier un profs
$router->map(
    'GET',
    '/teacher/[i:teacherid]',
    [
        'method' => 'teacherUpdateGet',
        'controller' => TeacherController::class
    ],
    'teacher_update_get'
);

$router->map(
    'POST',
    '/teacher/[i:teacherid]',
    [
        'method' => 'teacherUpdatePost',
        'controller' => TeacherController::class
    ],
    'teacher_update_post'
);

// routes pour modifier un étudiant
$router->map(
    'GET',
    '/student/[i:studentid]',
    [
        'method' => 'studentUpdateGet',
        'controller' => StudentController::class
    ],
    'student_update_get'
);

$router->map(
    'POST',
    '/student/[i:studentid]',
    [
        'method' => 'studentUpdatePost',
        'controller' => StudentController::class
    ],
    'student_update_post'
);

$router->map(
    'GET',
    '/appusers',
    [
        'method' => 'User',
        'controller' => UserController::class
    ],
    'user_list'
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
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::error404');
// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();