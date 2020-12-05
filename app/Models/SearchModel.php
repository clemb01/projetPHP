<?php

namespace App\Models;

class SearchModel
{
    private $query;
    private $result;

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($value)
    {
        $this->query = $value;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($value)
    {
        $this->result = $value;
    }
}