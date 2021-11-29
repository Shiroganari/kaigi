<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class CategoriesModel extends Model
{
    public static function getAll()
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT name FROM `categories`';
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getCategoryId(string $categoryName)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT id FROM `categories` WHERE name = :categoryName';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':categoryName', $categoryName);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}