<?php

namespace App\Controllers;

use App\Models\CoreModel;
use App\Models\Teachers;

class TeachersController extends CoreController
{

    /**
     * Display teachers 
     *
     * @return void
     */
    public function teachers() {

        // VERIFICATION QUE L'UTILISATEUR AIT LES DROITS
        $teachersModel = new Teachers
        teachers();
        $teachers = $teachersdModel->findAll();

        $this->show("teachers/teachers_list", [
            'teachers' => $teachers
        ]);
        
    }

    /**
     * Add a new teachers
     *
     * @return void
     */
    public function teachersAdd() {

        // VERIFICATION QUE L'UTILISATEUR AIT LES DROITS

        global $router;
        //$router->generate(...)

        $errorList = [];
        $newTeachers = new Teachers();

        //dump($_POST);
        //die();

        // Le formulaire a été soumis, les données sont envoyées
        if(isset($_POST) && !empty($_POST)) {

            // traitement du formulaire

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);

            $newTeachers->setName($name);


            if(empty($name)) {
                $errorList[] = "Le nom est vide !";
            }

            // tests sur les filtres
            if($name === false) {
                $errorList[] = "Le nom est invalide";
            }
            
            if(empty($errorList)) {
                // aucune erreur détectée
                // j'ai soumis mon formulaire et je n'ai pas d'erreur
                $retour = $newTeachers->insert();
                
                if ($retour == false) {
                    // gestion d'erreur
                    dump("erreur, problème avec la requête SQL");
                } else {
                    // redirection, car ma requête a fonctionnée
                    $route = $router->generate("teachers");
                    //dump($route);
                    header('Location: '.$route);
                }
            }
        } 

        // j'affiche la vue du formulaire dans 2 cas :
            // 1- je n'ai pas soumis le formulaire
            // 2- j'ai soumis le formulaire et il contient des erreurs

        $this->show("teachers/teachers_add", [
            'errors' => $errorList,
            'teachers' => $newTeachers
        ]);
    }

    /**
     * Update a teachers (route get||POST)
     */
    public function teachersEdit($teachersid) {
        // VERIFICATION QUE L'UTILISATEUR AIT LES DROITS

        global $router;

        $errorList = [];
        $teachersModel = new Teachers();
        $teachersFromDb = $teachersModel->find($teachersid);

        // Le formulaire a été soumis, les données sont envoyées
        if(isset($_POST) && !empty($_POST)) {

            // traitement du formulaire

            // Pour récupérer les différentes valeurs, on va définir des variables

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);

            $teachersFromDb->setName($name);

            if(empty($name)) {
                $errorList[] = "Le nom est vide !";
            }

            // tests sur les filtres
            if($name === false) {
                $errorList[] = "Le nom est invalide";
            }
            
            if(empty($errorList)) {
                // aucune erreur détectée
                // j'ai soumis mon formulaire et je n'ai pas d'erreur
                $retour = $teachersdFromDb->teachers();
                
                if ($retour == false) {
                    // gestion d'erreur
                    dump("erreur, problème avec la requête SQL");
                } else {
                    // redirection, car ma requête a fonctionnée
                    $route = $router->generate("teachers");
                    //dump($route);
                    header('Location: '.$route);
                }
            }
        } 


        // j'affiche la vue du formulaire dans 2 cas :
            // 1- je n'ai pas soumis le formulaire
            // 2- j'ai soumis le formulaire et il contient des erreurs

        $this->show("teachers/teachers_edit", [
            'errors' => $errorList,
            'teachers' => $teachersFromDb
        ]);
    }

}