<?php

namespace App\Models;

class SearchViewModel
{
    private $query;
    private $page;
    private $results;
    private $total_results;
    private $total_pages;

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

    public function Query()
    {
        return $this->query;
    }

    public function setQuery($value)
    {
        $this->query = $value;
    }

    public function Page()
    {
        return $this->page;
    }

    public function setPage($value)
    {
        $this->page = $value;
    }

    public function Results()
    {
        return $this->result;
    }

    public function setResults($value)
    {
        $this->result = array();
        foreach($value as $data)
        {
            array_push($this->result, new SearchResultModel($data));
        }
    }

    public function Total_results()
    {
        return $this->total_result;
    }

    public function setTotal_results($value)
    {
        $this->total_result = $value;
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

class SearchResultModel
{
    private $poster_path;
    private $overview;
    private $release_date;
    private $genre_ids;
    private $id;
    private $original_title;
    private $title;
    private $backdrop_path;

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

    public function Poster_path()
    {
        return $this->poster_path;
    }

    public function setPoster_path($value)
    {
        $this->poster_path = $value;
    }

    public function Overview()
    {
        return $this->overview;
    }

    public function setOverview($value)
    {
        $this->overview = $value;
    }

    public function Release_date()
    {
        return $this->release_date;
    }

    public function setRelease_date($value)
    {
        $this->release_date = $value;
    }

    public function Genre_ids()
    {
        return $this->genre_ids;
    }

    public function setGenre_ids($value)
    {
        $this->genre_ids = $value;
    }

    public function Id()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function Original_title()
    {
        return $this->original_title;
    }

    public function setOriginal_title($value)
    {
        $this->original_title = $value;
    }

    public function Title()
    {
        return $this->title;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function Backdrop_path()
    {
        return $this->backdrop_path;
    }

    public function setBackdrop_path($value)
    {
        $this->backdrop_path = $value;
    }
}