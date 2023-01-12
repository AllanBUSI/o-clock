<?php

namespace App\Controllers;

use App\Models\CoreModel;
use App\Models\Students;

class StudentsController extends CoreController
{

    /**
     * Display students
     *
     * @return void
     */
    public function students() {

        // VERIFICATION QUE L'UTILISATEUR AIT LES DROITS
        $studentsModel = new Students
        students();
        $students = $studentsdModel->findAll();

        $this->show("students/students_list", [
            'students' => $students
        ]);
        
    }

    /**
     * Add a new students
     *
     * @return void
     */
    public function studentsAdd() {

        // VERIFICATION QUE L'UTILISATEUR AIT LES DROITS

        global $router;
        //$router->generate(...)

        $errorList = [];
        $newStudents = new Studentss();

        //dump($_POST);
        //die();

        // Le formulaire a été soumis, les données sont envoyées
        if(isset($_POST) && !empty($_POST)) {

            // traitement du formulaire

            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);

            $newStudents->setFirstname($firstname);


            if(empty($firstname)) {
                $errorList[] = "Le nom est vide !";
            }

            // tests sur les filtres
            if($firstname === false) {
                $errorList[] = "Le nom est invalide";
            }
            
            if(empty($errorList)) {
                // aucune erreur détectée
                // j'ai soumis mon formulaire et je n'ai pas d'erreur
                $retour = $newStudents->insert();
                
                if ($retour == false) {
                    // gestion d'erreur
                    dump("erreur, problème avec la requête SQL");
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

        $this->show("students/students_add", [
            'errors' => $errorList,
            'students' => $newStudents
        ]);
    }

    /**
     * Update a students (route get||POST)
     */
    public function teachersEdit($teachersid) {
        // VERIFICATION QUE L'UTILISATEUR AIT LES DROITS

        global $router;

        $errorList = [];
        $studentsModel = new Students();
        $studentsFromDb = $studentsModel->find($studentsid);

        // Le formulaire a été soumis, les données sont envoyées
        if(isset($_POST) && !empty($_POST)) {

            // traitement du formulaire

            // Pour récupérer les différentes valeurs, on va définir des variables

            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);

            $studentsFromDb->setfirstname($firstname);

            if(empty($firstnamee)) {
                $errorList[] = "Le nom est vide !";
            }

            // tests sur les filtres
            if($firstname === false) {
                $errorList[] = "Le nom est invalide";
            }
            
            if(empty($errorList)) {
                // aucune erreur détectée
                // j'ai soumis mon formulaire et je n'ai pas d'erreur
                $retour = $studentsdFromDb->students();
                
                if ($retour == false) {
                    // gestion d'erreur
                    dump("erreur, problème avec la requête SQL");
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

        $this->show("students/students_edit", [
            'errors' => $errorList,
            'students' => $studentsFromDb
        ]);
    }

}