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
}

class Test
{
    public $name;
    public $firstname;
}