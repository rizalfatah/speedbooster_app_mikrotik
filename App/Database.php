<?php

namespace App;

use PDO;

class Database
{
    public \PDO $connection;

    public function __construct()
    {
        $dsn = "mysql:DB_USERNAME=;dbname=DB_DATABASE;charset=UTF-8;port=DB_POS";
        $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    }

    public static function query()
    {
    }
}
