<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Student extends CoreModel
{
    private $firstname;
    private $lastname;
    private $job;
    private $status;


    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM student';
        $pdoStatement = $pdo->query($sql);
        $studentsResults = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Student');

        return $studentsResults;
    } 

    public static function find($id){
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM student WHERE id = '.$id;
        $pdoStatement = $pdo->query($sql);
        $studentResult = $pdoStatement->fetchObject('App\Models\Student');

        return $studentResult;
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