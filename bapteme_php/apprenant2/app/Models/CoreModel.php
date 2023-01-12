<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models

// CLASSE ABSTRAITE
// ----------------
// ici lorsque je mets le mot clé abstract devant le nom de ma classe,
// cela m'empêche moi et les autres développeurs de mon équipe d'instancier un
// objet de cette classe !
// => ça permet de bloquer l'instanciation de cette classe => SECURITE
// => Les développeurs seront obligés d'instancier les classes modèles dérivées

// METHODE ABSTRAITE
// -----------------
// 1- On est obligés de rendre la classe abstraite
// CRUD => Si on fait un CRUD (Modèle), qu'est ce qu'on risque de ne "pas faire" ?
// - oublis ? Requêtes SQL => Les méthodes "active records"
// ==> Ca va permettre de forcer les classes dérivée à définir les méthodes de la classe abstraite
//


abstract class CoreModel
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;


    // La méthode que j'ai défini comme étant abstraite devra être
    // redéfinie dans les classes qui extends mon CoreModel
    // La méthode n'est pas définie ici, on défini uniquement son prototype
    abstract public static function find($id);
    abstract public static function findAll();

    //abstract public function insert();
    //abstract public function update();

    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
