<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class User extends Model
{
    public static function getAll()
    {
        try {
            $db = static::getDB();

            $stmt = $db->query('SELECT * FROM users;');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function registerNewUser($username, $email, $password, $location)
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO users (username, email, password, location) VALUES (?, ?, ?, ?);';
            $sth = $db->prepare($sql);
            $sth->execute([$username, $email, $password, $location]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}