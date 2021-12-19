<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    protected static function connect(): ?PDO
    {
        static $db = null;

        if ($db === null) {
            $host = DB_HOST;
            $dbname = DB_NAME;
            $username = DB_USER;
            $pass = DB_PASS;

            try {
                $db = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8",
                    $username, $pass
                );
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $db;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }

    public function get($query)
    {
        $db = static::connect();
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first($query)
    {
        $db = static::connect();
        $stmt = $db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function execute(string $query)
    {
        $db = static::connect();
        $db->query($query);
    }
}