<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireViewModel extends Model
{
    private $id;
    private $contenu;
    private $date;
    private $nouveauContenu;
    private $modifValide;
    private $valide;
    private $film_id;
    private $fk_userId;
    private $film_titre;
    private $film_logo;
    private $login;
    private $note;

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

    public function NouveauContenu()
    {
        return $this->nouveauContenu;
    }

    public function setNouveauContenu($value)
    {
        $this->nouveauContenu = $value;
    }

    public function ModifValide()
    {
        return $this->modifValide;
    }

    public function setModifValide($value)
    {
        $this->modifValide = $value;
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

    public function Fk_User_Id()
    {
        return $this->fk_userId;
    }

    public function setFk_User_Id($value)
    {
        $this->fk_userId = $value;
    }

    public function Film_titre()
    {
        return $this->Film_titre;
    }

    public function setFilm_titre($value)
    {
        $this->Film_titre = $value;
    }

    public function Film_logo()
    {
        return $this->Film_logo;
    }

    public function setFilm_logo($value)
    {
        $this->Film_logo = $value;
    }

    public function Login()
    {
        return $this->login;
    }

    public function setLogin($value)
    {
        $this->login = $value;
    }
}
