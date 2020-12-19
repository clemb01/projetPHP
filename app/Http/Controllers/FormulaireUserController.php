<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Note;

class FormulaireUserController extends BaseController
{
    public function getFormulaire()
    {
        return view('formulaireUser');
    }

    public function addUser(Request $request)
    {
        if($request->get('password') == $request->get('confirmPassword') && $request->get('password') != "")
        {
            $hashedPassword = hash('sha256', $request->get('password'));

            DB::insert("INSERT INTO user (nom, prenom, role, dateN, login, password) values (?, ?, ?, ?, ?, ?)", [$request->get('nom'), $request->get('prenom'),'user', $request->get('dateNaissance'), $request->get('pseudo'), $hashedPassword]);

            return redirect("/accueil");
        }
        else
        {
            return view('formulaireUser');
        }

    }

    public function checkLoginExist(Request $request)
    {
        $check = '';
        $query = "SELECT login FROM user";
        
        if($request->get('pseudo') !== '')
        {
            $login = $request->get('pseudo');
            $query .= " WHERE login ='$login'";
        }

        $results = DB::select($query);

        if(count($results) > 0)
        {
            $check = 'true';
        }
        else
        {
            $check = 'false';
        }
        return $check;

    }
}