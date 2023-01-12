<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{

    /**
    * Display users
    *
    * @return void
    */
    public function user()
    {
        $newuser = new AppUser();

        $user = $newuser->findAll();
        
        $this->show("user/user_list", [
            'users' => $user
        ]);
    }

    /**
    * Gestion de la deconnexion
    *
    * @return void
    */
    public function logout()
    {
        global $router;

        // On supprime les données liées a la connexion dans la session
        unset($_SESSION['userId']);
        unset($_SESSION['userRole']);

        $route = $router->generate("main-home");
        header('Location: '.$route);
        exit;
    }

    /**
    * Formulaire de gestion du login
    *
    * @return void
    */
    public function signinGet()
    {
        $this->show('user/signin');
    }

    /**
     * Formulaire de gestion du login
    *
    * @return void
    */
    public function signinPost()
    {
        global $router;

        $errorList = [];

        if(isset($_POST) && !empty($_POST)) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

            // On verifie si un compte a la même adresse email que $email
            $user = AppUser::findByEmail($email);
            if($user) {
                // Si le hash du mot de passe correspond au mot de passe en clair
                if(password_verify($password, $user->getPassword())) {
                    // On stocke en session l'id de l'utilisateur connecté
                    $_SESSION['userId'] = $user->getId();
                    $_SESSION['userRole'] = $user->getRole();

                    // redirection, car ma requête a fonctionnée
                    $route = $router->generate("main-home");
                    header('Location: '.$route);
                    exit;
                } else {
                    $errorList[] = "L'identifiant ou le mot de passe ne sont pas bon.";
                }
            } else {
                $errorList[] = "L'identifiant ou le mot de passe ne sont pas bon.";
            }

        }

        $this->show("user/signin", [
            'errors' => $errorList
        ]);
    }
}