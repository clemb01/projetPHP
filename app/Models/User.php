<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email',
    // ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    

    private $intId;
    private $stringNom;
    private $stringPrenom;
    private $stringRole;
    private $dateDateNaissance;
    private $stringLogin;
    private $stringPassword;

    public function getId()
    {
        return $this->intId;
    }

    public function setId($value)
    {
        $this->intId = $value;
    }

    public function getNom()
    {
        return $this->stringNom;
    }

    public function setNom($value)
    {
        $this->stringNom = $value;
    }
    public function getPrenom()
    {
        return $this->stringPrenom;
    }

    public function setPrenom($value)
    {
        $this->stringPrenom = $value;
    }
    public function getRole()
    {
        return $this->stringRole;
    }

    public function setRole($value)
    {
        $this->stringRole = $value;
    }
    public function getDateN()
    {
        return $this->dateDateNaissance;
    }

    public function setDateN($value)
    {
        $this->dateDateNaissance = $value;
    }
    public function getLogin()
    {
        return $this->stringLogin;
    }

    public function setLogin($value)
    {
        $this->stringLogin = $value;
    }

    public function getPassword()
    {
        return $this->stringPassword;
    }

    public function setPassword($value)
    {
        $this->stringPassword = $value;
    }

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

    public static function getUserByLogin($login){
        //$user= DB::table('user')->where('login', $login)->first;
        $user = DB::select("SELECT * FROM user WHERE login = ? LIMIT 1", [$login]);
        if(!empty($user)){
            return new User($user[0]);
        }
        else{
            return null;
        }
    }
}
