<?php

abstract class db_abstract
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


}

?>