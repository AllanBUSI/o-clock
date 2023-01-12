<?php

    namespace App\Controllers;

    use App\Models\AppUser;

    class UserController extends CoreController {

        public function userAdd()
        {

            global $router;
            $errorList = [];
            if(isset($_POST) && !empty($_POST)) {
                // Ici, on execute l'insertion d'un nouvel utilisateur

                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
                $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
                $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
                $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_SPECIAL_CHARS);
                $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_SPECIAL_CHARS);

                if(empty($email)) {
                    $errorList[] = "Email doit etre rempli";
                }
                if(empty($password)) {
                    $errorList[] = "Password doit etre rempli";
                }
                if(empty($firstname)) {
                    $errorList[] = "prénom doit etre rempli";
                }
                if(empty($lastname)) {
                    $errorList[] = "Nom de famille doit etre rempli";
                }
                if(empty($role)) {
                    $errorList[] = "Role doit etre rempli";
                }
                if(empty($status)) {
                    $errorList[] = "Status doit etre rempli";
                }
                // On passe dans ce if si aucune erreurs n'a été ajoutée
                if(empty($errorList)) {
                    $newUser = new AppUser();
                    $newUser->setEmail($email);
                    $newUser->setPassword($password);
                    $newUser->setFirstname($firstname);
                    $newUser->setLastname($lastname);
                    $newUser->setRole($role);
                    $newUser->setStatus($status === "actif" ? 1 : 2);
                    $insertionResult = $newUser->insert();
                    if($insertionResult) {
                        $route = $router->generate("user_list");
                        header('Location: '.$route);
                        exit;
                    } else {
                        $errorList[] = "Erreur lors de l'insertion d'un utilisateur, merci de contacter un administrateur du site";
                    }
                }

            }

            $CSRFToken = bin2hex(random_bytes(32));
            $_SESSION['token'] = $CSRFToken;

            // Afficher le template user add
            $this->show("user/user_add", [
                'errors' => $errorList,
                'CSRF' => $CSRFToken
            ]);
        }
        public function users()
        {
            $errorList = [];
            $userModel = new AppUser();
            // Contient la liste de tout les utilisateurs
            $users = $userModel->findAll();

            // Afficher le template user list
            $this->show("user/user_list", [
                'errors' => $errorList,
                'users' => $users
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
        public function login()
        {
            global $router;

            $errorList = [];

            if(isset($_POST) && !empty($_POST)) {
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                // @WARNING Si on met des carac speciaux dans le mdp, ils seront enlevés a la ligne suivante
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

            $this->show("user/login", [
                'errors' => $errorList
            ]);
            // créer un formulaire : login/password : se connecter

        }

    }