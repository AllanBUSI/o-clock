<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Student extends CoreModel
{
    private $firstname;
    private $lastname;
    private $status;
    private $teacher_id;

    /**
     * Méthode permettant de récupérer un enregistrement de la table student en fonction d'un id donné
     *
     * @param int $studentId ID de l'étudiant
     * @return Student
     */
    public static function find($studentId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `student` WHERE `id` =' . $studentId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $student = $pdoStatement->fetchObject('App\Models\Student');

        // retourner le résultat
        return $student;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table student
     *
     * @return bool
     */
    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `student`
            SET
                firstname = '{$this->firstname}',
                lastname = '{$this->lastname}',
                status = '{$this->status}',
                teacher_id = '{$this->teacher_id}',
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        // Execution de la requête de mise à jour (exec, pas query)
        $updatedRows = $pdo->exec($sql);

        // On retourne VRAI, si au moins une ligne ajoutée
        return ($updatedRows > 0);
    }

    /**
     * Méthode permettant de supprimer un enregistrement dans la table student
     *
     * @return bool
     */
    public static function delete($id)
    {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->prepare('DELETE FROM `student` WHERE id = :id;');

        $pdoStatement->execute([':id' => $id]);
        return true;
    }


    /**
     * Méthode permettant d'ajouter un enregistrement dans la table student
     *
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        $sql = "
            INSERT INTO `student` (firstname, lastname, status, teacher_id)
            VALUES ('{$this->firstname}','{$this->lastname}','{$this->status}','{$this->teacher_id}')
        ";

        // Execution de la requête d'insertion (exec, pas query)
        $insertedRows = $pdo->exec($sql);

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // On récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
        }

        return false;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table student
     *
     * @return Student[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `student`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Student');

        return $results;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of teacher_id
     */ 
    public function getTeacher_id()
    {
        return $this->teacher_id;
    }

    /**
     * Set the value of teacher_id
     *
     * @return  self
     */ 
    public function setTeacher_id($teacher_id)
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }
}