<?php

namespace App\Controllers;

use App\Models\Teacher;

class TeacherController extends MainController 
{
    public function teachers()
    {
        $teachers = Teacher::findAll();

        $this->show("teacher/teacher_list", [
            'teachers' => $teachers
        ]);
    }

    public function studentAdd() {
        global $router;
        //$router->generate(...)

        $errorList = [];
        $newTeacher = new Teacher();

        // Le formulaire a été soumis, les données sont envoyées
        if(isset($_POST) && !empty($_POST)) {

            // traitement du formulaire

            // Pour récupérer les différentes valeurs, on va définir des variables
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
            $status = filter_input(INPUT_POST, "status", FILTER_VALIDATE_INT);

                $newStudent->setFirstname($firstname);
                $newStudent->setLastname($lastname);
                $newStudent->setStatus($status);

            if(empty($firstname)) {
                $errorList[] = "Le nom est vide !";
            }

            // Si jamais vous avez par exemple, un NULL autorisé dans la base de données
            // sur le champs subtitle de la tableau Category =>
            // l'erreur ci-dessous n'est pas vraiment une erreur, on ne la gère pas !
            /*if(empty($subtitle)) {
                $errorList[] = "Le sous-titre est vide !";
            }*/
            if(empty($lastname)) {
                $errorList[] = "le prenom est vide!";
            }

            // tests sur les filtres
            if($lastname === false) {
                $errorList[] = "Le prénom est invalide";
            }
            if($firstname === false) {
                $errorList[] = "Le le nom est invalide";
            }
            if($status === false) {
                $errorList[] = "le status est vide";
            }
            
            if(empty($errorList)) {
                // aucune erreur détectée
                // j'ai soumis mon formulaire et je n'ai pas d'erreur
                $retour = $newStudent->insert();

                if ($retour == false) {
                    // gestion d'erreur
                    var_dump("erreur, problème avec la requête SQL");
                } else {
                    // redirection, car ma requête a fonctionnée
                    $route = $router->generate("students");
                    //dump($route);
                    header('Location: '.$route);
                }
            }
        } 

        // j'affiche la vue du formulaire dans 2 cas :
            // 1- je n'ai pas soumis le formulaire
            // 2- j'ai soumis le formulaire et il contient des erreurs

        $this->show("student/student_add", [
            'errors' => $errorList,
            'student' => $newStudent
        ]);
    }
}