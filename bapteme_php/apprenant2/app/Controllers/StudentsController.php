<?php

namespace App\Controllers;

use App\Models\Student;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class StudentsController extends CoreController
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

        $studentsList = Student::findAll();

        $this->show('students/students_list', ["studentsResults" => $studentsList]);

        
    }
}