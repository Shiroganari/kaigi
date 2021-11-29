<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class TopicsModel extends Model
{
    public static function getAll()
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT name FROM `topics`';
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getTopicByCategory(int $categoryID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT name FROM `topics` WHERE categories_id = :categoryID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':categoryID', $categoryID);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}