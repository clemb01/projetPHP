<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    private $id;
    private $note;
    private $filmId;
    private $fk_UserId;

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

    public function Note()
    {
        return $this->note;
    }

    public function setNote($value)
    {
        $this->note = $value;
    }

    public function FilmId()
    {
        return $this->filmId;
    }

    public function setFilm_Id($value)
    {
        $this->filmId = $value;
    }

    public function Fk_User_Id()
    {
        return $this->fk_UserId;
    }

    public function setFk_User_Id($value)
    {
        $this->fk_UserId = $value;
    }
}
