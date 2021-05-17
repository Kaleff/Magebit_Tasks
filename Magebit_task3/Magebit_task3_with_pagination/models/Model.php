<?php


abstract class Model
{
    protected $pdo;
    public function __construct() {
        $this->pdo = DB::getConnection();
    }
}