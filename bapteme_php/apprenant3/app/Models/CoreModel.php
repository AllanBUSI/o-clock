<?php

namespace App\Models;

abstract class CoreModel
{
    protected $created_at;

    protected $updated_at;



    
    abstract public static function findAll();

    

    

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }
}