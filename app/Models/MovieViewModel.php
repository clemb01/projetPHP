<?php

namespace App\Models;

class MovieViewModel
{
    private $movie;
    private $trailer;
    private $cast;

    public function getMovie()
    {
        return $this->movie;
    }

    public function setMovie($value)
    {
        $this->movie = $value;
    }

    public function getTrailer()
    {
        return $this->trailer;
    }

    public function setTrailer($value)
    {
        $this->trailer = $value;
    }

    public function getCast()
    {
        return $this->cast;
    }

    public function setCast($value)
    {
        $this->cast = $value;
    }
}