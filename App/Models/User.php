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
            exit;
        }
    }

    public static function checkUser(string $username, string $email)
    {
        try {
            $db = static::getDB();

            $stmt = $db->prepare("SELECT * FROM `users` WHERE username = '" . $username . "' OR email = '" . $email . "'");
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function registerNewUser(string $username, string $email, string $password):void
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?);';
            $sth = $db->prepare($sql);
            $sth->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function completeUserRegister(int $userID, string $firstName, string $lastName, string $descr, string $locationCountry, string $locationCity):void
    {
        try {
            $db = static::getDB();

            $stmt = $db->prepare("UPDATE users SET first_name = '".$firstName."' WHERE id = '".$userID."' ");
            $stmt->execute();

            $stmt = $db->prepare("UPDATE users SET last_name = '".$lastName."' WHERE id = '".$userID."' ");
            $stmt->execute();

            $stmt = $db->prepare("UPDATE users SET description = '".$descr."' WHERE id = '".$userID."' ");
            $stmt->execute();

            $stmt = $db->prepare("UPDATE users SET location_country = '".$locationCountry."' WHERE id = '".$userID."' ");
            $stmt->execute();

            $stmt = $db->prepare("UPDATE users SET location_city = '".$locationCity."' WHERE id = '".$userID."' ");
            $stmt->execute();

            $stmt = $db->prepare("UPDATE users SET status = '2' WHERE id = '".$userID."' ");
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function getUser(string $email)
    {
        try {
            $db = static::getDB();

            $stmt = $db->prepare("SELECT * FROM `users` WHERE email = '".$email."'");
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}