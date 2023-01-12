<?php

namespace App\Controllers;

class CoreController
{

    public function __construct()
    {
        global $match;
        
        $currentRoute = $match['name'];

        // Ici, on va pouvoir implementer tout ce qui est lié a l'autorisation de nos routes
        $acl = [
            //'main-home' => [],
            'teacher_list' => ['admin'],
            'student_list' => ['admin', 'user'],
            'teacher_add_get' => ['admin'],
            'teacher_add_post' => ['admin'],
            'student_add_get' => ['admin', 'user'],
            'student_add_post' => ['admin', 'user'],
            //'signin_get' => [],
            //'signin_post' => [],
            //'user_logout' => [],
            //'error403' => [],
            //'error404' => [],
            'teacher_delete' => ['admin'],
            'student_delete' => ['admin', 'user'],
            'teacher_update_post' => ['admin'],
            'teacher_update_get' => ['admin'],
            'student_update_get' => ['admin', 'user'],
            'student_update_get' => ['admin', 'user'],
            'user_list' => ['admin']
        ];
        if(array_key_exists($currentRoute, $acl)) {
            // La route est une route protegée
            $this->checkAuthorization($acl[$currentRoute]);
        }
    }

    protected function checkAuthorization($roles=[]) {
        global $router;

        if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
            if(in_array($_SESSION['userRole'], $roles)) {
                // On a le droit d'acceder a la ressource
                return true;
            } else {
                // On n'a pas le droit d'acceder a la ressource
                header('HTTP/1.0 403 Forbidden');

                $this->show('error/error_403');
                exit;
            }
        } else {
            $route = $router->generate("signin_get");
            header('Location: '.$route);
            exit;
        }
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;

        // Si ici j'ai besoin de data communes à l'ensemble de mes vues,
        // par exemple dynamiser une liste de navigation, dans ces cas là oui je le fais ici

        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../Views/layout/header.tpl.php';
        require_once __DIR__ . '/../Views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../Views/layout/footer.tpl.php';
    }
}