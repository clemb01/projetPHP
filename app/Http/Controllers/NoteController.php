<?php

class Controller_Note extends BaseController
{
    public $note /*= recup note à partir du site*/;
}

public float $somme;
public float $moyenne;

function public float CalculMoyenne(array[int] $Note)
{
    for( int $i = 0; $i < $Note.count; $i ++)
    {
        $somme = $somme + $note[$i]; 
    }

    $moyenne = $somme / $Note.count;

    return $moyenne;

}

?>