<?php

namespace Core;

use PDO;
use PDOException;

class Model
{
    protected static function getDB()
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
}