<?php


namespace App\Model;


class Manager
{
    protected function dbConnect()
    {
        $database = new \PDO ('mysql:host=db5000172777.hosting-data.io;dbname=dbs167667;charset=utf8', 'dbu248270',
            'Orcandie78!');
        $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $database;

    }
}