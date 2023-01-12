<?php

namespace App\Controllers;

use App\Models\Teacher;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class TeachersController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller

        $teachersList = Teacher::findAll();

        $this->show('teachers/teachers_list', ["teachersResults" => $teachersList]);

        }

        public function add()
        {
            // On appelle la méthode show() de l'objet courant
            // En argument, on fournit le fichier de Vue
            // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
    
    
            $this->show('teachers/teachers_add');
    
            }
        
}