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

    public static function checkUser($username, $email)
    {
        try {
            $db = static::getDB();

            $stmt = $db->prepare("SELECT * FROM `users` WHERE username = '".$username."' OR email = '".$email."'");
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function registerNewUser($username, $email, $password)
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?);';
            $sth = $db->prepare($sql);
            $sth->execute([$username, $email, $password]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getUser($email, $password)
    {
        try {
            $db = static::getDB();

            $stmt = $db->prepare("SELECT * FROM `users` WHERE email = '".$email."' AND password = '".$password."'");
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}