<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function test()
    {     
        $test = array(new Test(), new Test(), new Test());
        $test[0]->name = "Michel";
        $test[0]->firstname = "Henri";
        $test[1]->name = "Michelel";
        $test[1]->firstname = "Henriette";
        $test[2]->name = "Michelelazreaz";
        $test[2]->firstname = "Henriettazdaze";
        
        return view('greeting', ['tests' => $test]);
    }

    //Recuperation des users depuis la BDD
    public function RecupUsers()
    {
        $results = DB::select("SELECT * FROM user");

        return view('nom_de_la_view', ['users' => $users]);
    }
}

class Test
{
    public $name;
    public $firstname;
}