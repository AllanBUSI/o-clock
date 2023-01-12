<?php

namespace App\Controllers;

use App\Models\Student;
use App\Models\Teacher;

class StudentController extends CoreController {

    /**
     * edit a student
     *
     * @return void
     */
    public function studentUpdateGet($studentid)
    {
        $newstudent = new Student();
        $studentFromDb = $newstudent->find($studentid);

        $newteacher = new Teacher();

        $teacher = $newteacher->findAll();

        $this->show("student/student_update", [
            'student' => $studentFromDb,
            'teachers' => $teacher
        ]);
    }

    /**
     * edit a student
     *
     * @return void
     */
    public function studentUpdatePost($studentid) {
        global $router;

        $errorList = [];

        // Avec la méthode définie STATIC
        $studentFromDb = Student::find($studentid);

        // Traiter les données du formulaire

        // Le formulaire a été soumis, les données sont envoyées
        if(isset($_POST) && !empty($_POST)) {

            // traitement du formulaire

        // On récupére les valeurs
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $teacher_id = filter_input(INPUT_POST, 'teacher');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $studentFromDb->setFirstname($firstname);
        $studentFromDb->setLastname($lastname);
        $studentFromDb->setTeacher_id($teacher_id);
        $studentFromDb->setStatus($status);

        // Gestion de erreurs
        if(empty($firstname)) {
            $errorList[] = "Le prénom est vide ou invalide !";
        }
        if (empty($lastname)) {
            $errorList[] = "Le nom est vide ou invalide !";
        }
        if(empty($teacher_id)) {
            $errorList[] = "Le status est vide ou invalide !";
        }
        if(empty($status)) {
            $errorList[] = "Le status est vide ou invalide !";
        }
            
            if(empty($errorList)) {
                // aucune erreur détectée
                // j'ai soumis mon formulaire et je n'ai pas d'erreur
                $retour = $studentFromDb->update();

                if ($retour == false) {
                    // gestion d'erreur
                    dump("erreur, problème avec la requête SQL");
                } else {
                    // redirection, car ma requête a fonctionnée
                    $route = $router->generate("student_list");
                    //dump($route);
                    header('Location: '.$route);
                }
            }
        } 

        $this->show("student/student_update", [
            'errors' => $errorList,
            'student' => $studentFromDb
        ]);
    }

    /**
     * delete a student
     *
     * @return void
     */
    public function studentDelete($studentid)
    {
        $errorList = [];
        $result = Student::delete($studentid);
        if(!$result) {
            $errorList[] = 'Erreur de suppression';
        }
        $student = new Student();
        $students = $student->findAll();

        $this->show("student/student_list", [
            'students' => $students
        ]);
    }

    /**
     * Add a new student
     *
     * @return void
     */
    public function studentAddGet()
    {
        $newteacher = new Teacher();

        $teacher = $newteacher->findAll();
        
        $this->show("student/student_add", [
            'teachers' => $teacher
        ]);
    }

    /**
     * Add a new student
     *
     * @return void
     */
    public function studentAddPost()
    {

        global $router;
        $errorList = [];

        $newstudent = new Student();

    if (isset($_POST) && !empty($_POST)) {
        // var_dump($_POST);die;

        // On récupére les valeurs
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $teacher_id = filter_input(INPUT_POST, 'teacher');
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        $newstudent->setFirstname($firstname);
        $newstudent->setLastname($lastname);
        $newstudent->setTeacher_id($teacher_id);
        $newstudent->setStatus($status);

        // Gestion de erreurs
        if(empty($firstname)) {
            $errorList[] = "Le prénom est vide ou invalide !";
        }
        if (empty($lastname)) {
            $errorList[] = "Le nom est vide ou invalide !";
        }
        if(empty($teacher_id)) {
            $errorList[] = "Le status est vide ou invalide !";
        }
        if(empty($status)) {
            $errorList[] = "Le status est vide ou invalide !";
        }

        if(empty($errorList)) {
            // aucune erreur détectée
            // j'ai soumis mon formulaire et je n'ai pas d'erreur
            $retour = $newstudent->insert();

            if ($retour == false) {
                // gestion d'erreur
                dump("erreur, problème avec la requête SQL");
            } else {
                // redirection, car ma requête a fonctionnée
                $route = $router->generate("student_list");
                //dump($route);
                header('Location: '.$route);
            }
        }
    }

        
        $this->show("student/student_add", [
            'errors' => $errorList,
            'students' => $newstudent
        ]);
    }

    /**
     * Display Student 
     *
     * @return void
     */
    public function student()
    {
        $newstudent = new Student();

        $student = $newstudent->findAll();
        
        $this->show("student/student_list", [
            'students' => $student
        ]);
    }
}