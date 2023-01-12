<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel
{
    private $email;
    private $name;
    private $password;
    private $role;
    private $status;

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table app_user
     *
     * @return User[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `app_user`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\AppUser');

        return $results;
    }

    public static function findByEmail($email)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // Preparation d'une requete avec un placeholder
        $pdoStatement = $pdo->prepare('SELECT * FROM app_user WHERE email = :email');

        // Execution de la requete en remplacant le placeholder
        $pdoStatement->execute([':email' => $email]);

        // un seul résultat => fetchObject
        $user = $pdoStatement->fetchObject('App\Models\AppUser');

        // retourner le résultat
        return $user;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password =  password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

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
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }
}