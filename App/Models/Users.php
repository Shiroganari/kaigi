<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class Users extends Model
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

    public static function registerNewUser(string $username, string $email, string $password): void
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

    public static function completeUserRegister(array $userData): void
    {
        try {
            $db = static::getDB();

            $stmt = $db->prepare('UPDATE `users` SET first_name = :firstName WHERE id = :userID');
            $stmt->execute([
                ':firstName' => $userData['firstName'],
                ':userID' => $userData['userID']
            ]);

            $stmt = $db->prepare('UPDATE `users` SET last_name = :lastName WHERE id = :userID');
            $stmt->execute([
                ':lastName' => $userData['lastName'],
                ':userID' => $userData['userID']
            ]);

            $stmt = $db->prepare('UPDATE `users` SET description = :description WHERE id = :userID');
            $stmt->execute([
                ':description' => $userData['description'],
                ':userID' => $userData['userID']
            ]);

            $stmt = $db->prepare('UPDATE `users` SET location_country = :locationCountry WHERE id = :userID');
            $stmt->execute([
                ':locationCountry' => $userData['locationCountry'],
                ':userID' => $userData['userID']
            ]);

            $stmt = $db->prepare('UPDATE `users` SET location_city = :locationCity WHERE id = :userID');
            $stmt->execute([
                ':locationCity' => $userData['locationCity'],
                ':userID' => $userData['userID']
            ]);

            $stmt = $db->prepare('UPDATE `users` SET status = :status WHERE id = :userID');
            $stmt->execute([
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