<?php

namespace Application\Lib;

class DatabaseConnection
{
    public static ?\PDO $database = null;

    public static function getConnection(): \PDO
    {
        if (self::$database === null) {
            self::$database = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        }

        return self::$database;
    }
}
