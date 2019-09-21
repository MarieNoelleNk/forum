<?php


namespace App\Model;


class Manager
{
    protected function dbConnect()
    {
        $database = new \PDO ('mysql:host=localhost;dbname=orcandie;charset=utf8', 'root', '');
        $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $database;

    }
}