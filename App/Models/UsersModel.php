<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class UsersModel extends Model
{
    public static function getAll()
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM users';
            $stmt = $db->query($sql);
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

            $sql = 'SELECT * FROM `users` WHERE username = :username OR email = :email';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email
            ]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function userRegistration(string $username, string $email, string $password): void
    {
        try {
            $db = static::getDB();

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO `users` (username, email, password) VALUES (:username, :email, :password)';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $passwordHash
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function completeUserRegistration(array $userData): void
    {
        try {
            $db = static::getDB();

            $sql = 'UPDATE `users` SET 
                first_name = :firstName,
                last_name = :lastName,
                description = :description,
                location_country = :locationCountry,
                location_city = :locationCity,
                status = :status
            WHERE id = :userID';

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':firstName' => $userData['firstName'],
                ':lastName' => $userData['lastName'],
                ':description' => $userData['description'],
                ':locationCountry' => $userData['locationCountry'],
                ':locationCity' => $userData['locationCity'],
                ':status' => 2,
                ':userID' => $userData['userID']
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function getUser(string $email)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM `users` WHERE email = :email';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function getUserById(int $id)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM `users` WHERE id = :userID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':userID', $id);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}