<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Teacher extends CoreModel
{
    private $firstname;
    private $lastname;
    private $job;
    private $status;

    /**
     * Méthode permettant de récupérer un enregistrement de la table teacher en fonction d'un id donné
     *
     * @param int $teacherId ID du prof
     * @return Teacher
     */
    public static function find($teacherId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = '
            SELECT *
            FROM teacher
            WHERE id = ' . $teacherId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $teacher = $pdoStatement->fetchObject('App\Models\Teacher');

        // retourner le résultat
        return $teacher;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table teacher
     *
     * @return bool
     */
    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `teacher`
            SET
                firstname = '{$this->firstname}',
                lastname = '{$this->lastname}',
                job = '{$this->job}',
                status = '{$this->status}',
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        // Execution de la requête de mise à jour (exec, pas query)
        $updatedRows = $pdo->exec($sql);

        // On retourne VRAI, si au moins une ligne ajoutée
        return ($updatedRows > 0);
    }

    /**
     * Méthode permettant de supprimer un enregistrement dans la table teacher
     *
     * @return bool
     */
    public static function delete($id)
    {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->prepare('DELETE FROM `teacher` WHERE id = :id;');

        $pdoStatement->execute([':id' => $id]);
        return true;
    }

    /**
     * Méthode permettant d'ajouter un enregistrement dans la table teacher
     *
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        $sql = "
            INSERT INTO `teacher` (firstname, lastname, job, status)
            VALUES ('{$this->firstname}','{$this->lastname}','{$this->job}','{$this->status}')
        ";

        // Execution de la requête d'insertion (exec, pas query)
        $insertedRows = $pdo->exec($sql);

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }


    /**
     * Méthode permettant de récupérer tous les enregistrements de la table teacher
     *
     * @return Teacher[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `teacher`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Teacher');

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
     * Get the value of job
     */ 
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set the value of job
     *
     * @return  self
     */ 
    public function setJob($job)
    {
        $this->job = $job;

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
}