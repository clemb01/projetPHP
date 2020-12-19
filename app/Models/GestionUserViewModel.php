<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestionUserViewModel extends Model
{
    private $users;
    private $page;
    private $total_pages;

    public function __construct($donnees = null){
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

    public function Users()
    {
        return $this->users;
    }

    public function setUsers($value)
    {
        $this->users = $value;
    }

    public function Page()
    {
        return $this->page;
    }

    public function setPage($value)
    {
        $this->page = $value;
    }

    public function Total_pages()
    {
        return $this->total_pages;
    }

    public function setTotal_pages($value)
    {
        $this->total_pages = $value;
    }
}
