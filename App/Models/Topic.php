<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class Topic extends Model
{
    public static function getAll()
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT name FROM topics';
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}