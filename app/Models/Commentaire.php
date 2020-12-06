<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    private $id;
    private $contenu;
    private $date;
    private $valide;
    private $film_id;
    private $nom_film;
    private $fk_userId;

    public function __construct($donnees){
        if($donnees) 
            $this->hydrate($donnees);
    }

    public function hydrate($donnees)
    {
        foreach($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function Id()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function Contenu()
    {
        return $this->contenu;
    }

    public function setContenu($value)
    {
        $this->contenu = $value;
    }

    public function Date()
    {
        return $this->date;
    }

    public function setDate($value)
    {
        $this->date = $value;
    }

    public function Valide()
    {
        return $this->valide;
    }

    public function setValide($value)
    {
        $this->valide = $value;
    }

    public function FilmId()
    {
        return $this->filmId;
    }

    public function setFilm_Id($value)
    {
        $this->filmId = $value;
    }

    public function Nom_Film()
    {
        return $this->nom_film;
    }

    public function setNom_Film($value)
    {
        $this->nom_film = $value;
    }

    public function Fk_User_Id()
    {
        return $this->fk_userId;
    }

    public function setFk_User_Id($value)
    {
        $this->fk_userId = $value;
    }
}
