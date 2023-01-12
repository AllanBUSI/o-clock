<?php

namespace App\Controllers;

use App\Models\Teacher;

class TeacherController extends CoreController {

    /**
     * edit a teacher
     *
     * @return void
     */
    public function teacherUpdateGet($teacherid)
    {
        $newteacher = new Teacher();
        $teacherFromDb = $newteacher->find($teacherid);

        $this->show("teacher/teacher_update", [
            'teacher' => $teacherFromDb
        ]);
    }

    /**
     * edit a teacher
     *
     * @return void
     */
    public function teacherUpdatePost($teacherid) 
    {

        global $router;

        $errorList = [];

        $teacherFromDb = Teacher::find($teacherid);

        if(isset($_POST) && !empty($_POST)) {
            // var_dump($_POST);die;

        // On récupére les valeurs
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $job = filter_input(INPUT_POST, 'job');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $teacherFromDb->setFirstname($firstname);
        $teacherFromDb->setLastname($lastname);
        $teacherFromDb->setJob($job);
        $teacherFromDb->setStatus($status);

        // Gestion de erreurs
        if(empty($firstname)) {
            $errorList[] = "Le prénom est vide ou invalide !";
        }
        if(empty($lastname)) {
            $errorList[] = "Le nom est vide ou invalide !";
        }
        if(empty($job)) {
            $errorList[] = "Le titre est vide ou invalide !";
        }
        if(empty($status)) {
            $errorList[] = "Le status est vide ou invalide !";
        }

            
        if(empty($errorList)) {
            // aucune erreur détectée
            // j'ai soumis mon formulaire et je n'ai pas d'erreur
            $retour = $teacherFromDb->update();
                
            if ($retour == false) {
                // gestion d'erreur
                dump("erreur, problème avec la requête SQL");
            } else {
                // redirection, car ma requête a fonctionnée
                $route = $router->generate("teacher_list");
                header('Location: '.$route);
                }
            }
        } 

        // affichage du formulaire
        $this->show("teacher/teacher_update", [
            'errors' => $errorList,
            'teacher' => $teacherFromDb
        ]);
    }

    /**
     * delete a teacher
     *
     * @return void
     */
    public function teacherDelete($teacherid)
    {
        $errorList = [];
        $result = Teacher::delete($teacherid);
        if(!$result) {
            $errorList[] = 'Erreur de suppression';
        }
        $teacher = new Teacher();
        $teachers = $teacher->findAll();

        $this->show("teacher/teacher_list", [
            'teachers' => $teachers
        ]);
    }

    /**
     * Add a new teacher
     *
     * @return void
     */
    public function teacherAddGet()
    {
        $this->show("teacher/teacher_add");
    }

    /**
     * Add a new teacher
     *
     * @return void
     */
    public function teacherAddPost()
    {

        global $router;
        $errorList = [];

        $newteacher = new Teacher();

    if (isset($_POST) && !empty($_POST)) {

        // On récupére les valeurs
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $job = filter_input(INPUT_POST, 'job');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $newteacher->setFirstname($firstname);
        $newteacher->setLastname($lastname);
        $newteacher->setJob($job);
        $newteacher->setStatus($status);

        // Gestion de erreurs
        if(empty($firstname)) {
            $errorList[] = "Le prénom est vide ou invalide !";
        }
        if(empty($lastname)) {
            $errorList[] = "Le nom est vide ou invalide !";
        }
        if(empty($job)) {
            $errorList[] = "Le titre est vide ou invalide !";
        }
        if(empty($status)) {
            $errorList[] = "Le status est vide ou invalide !";
        }

        if(empty($errorList)) {
            // aucune erreur détectée
            // j'ai soumis mon formulaire et je n'ai pas d'erreur
            $retour = $newteacher->insert();

            if ($retour == false) {
                // gestion d'erreur
                dump("erreur, problème avec la requête SQL");
            } else {
                // redirection, car ma requête a fonctionnée
                $route = $router->generate("teacher_list");
                //dump($route);
                header('Location: '.$route);
            }
        }
    }

        
        $this->show("teacher/teacher_add", [
            'errors' => $errorList,
            'teachers' => $newteacher
        ]);
    }

    /**
     * Display teacher 
     *
     * @return void
     */
    public function teacher()
    {
        $newteacher = new Teacher();

        $teacher = $newteacher->findAll();
        
        $this->show("teacher/teacher_list", [
            'teachers' => $teacher
        ]);
    }
}