<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

    class AppUser extends CoreModel
    {
        /**
         * @var string
         */
        private $email;

        /**
         * @var string
         */
        private $password;

        /**
         * @var string
         */
        private $name;

    
        /**
         * @var string
         */
        private $role;

        /**
         * @var int
         */
        private $status;

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
        public static function find($id)
        {

        }
        public static function findAll()
        {
            $pdo = Database::getPDO();
            $sql = 'SELECT * FROM `app_user`';
            $pdoStatement = $pdo->query($sql);
            $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\AppUser');

            return $results;
        }
        public function insert()
        {
            // se connecter à la BDD
            $pdo = Database::getPDO();

            
            $pdoStatement = $pdo->prepare("INSERT INTO `app_user` (email, password, firstname, lastname, role, status) VALUES (:email, :password, :firstname, :lastname, :role, :status)");

            
            $result = $pdoStatement->execute([
                ':email' => $this->getEmail(),
                ':password' => $this->getPassword(),
                ':name' => $this->getName(),
                ':role' => $this->getRole(),
                ':status' => $this->getStatus()
            ]);
            // retourner le résultat
            return $result;
        }
        public function update()
        {
            
        }

        /**
         * Get the value of email
         *
         * @return  string
         */ 
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @param  string  $email
         *
         * @return  self
         */ 
        public function setEmail(string $email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of password
         *
         * @return  string
         */ 
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * Set the value of password
         *
         * @param  string  $password
         *
         * @return  self
         */ 
        public function setPassword(string $password)
        {
            // On hash automatiquement le mot de passe avant de l'assigner a la propriété
            $this->password = password_hash($password, PASSWORD_DEFAULT);

            return $this;
        }


        /**
         * Get the value of role
         *
         * @return  string
         */ 
        public function getRole()
        {
            return $this->role;
        }

        /**
         * Set the value of role
         *
         * @param  string  $role
         *
         * @return  self
         */ 
        public function setRole(string $role)
        {
            $this->role = $role;

            return $this;
        }

        /**
         * Get the value of status
         *
         * @return  int
         */ 
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * Set the value of status
         *
         * @param  int  $status
         *
         * @return  self
         */ 
        public function setStatus(int $status)
        {
            $this->status = $status;

            return $this;
        }

        /**
         * Get the value of name
         *
         * @return  string
         */ 
        public function getName()
        {
            return $this->name;
        }

        /**
         * Set the value of name
         *
         * @param  string  $name
         *
         * @return  self
         */ 
        public function setName(string $name)
        {
            $this->name = $name;

            return $this;
        }
    }