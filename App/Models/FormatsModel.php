<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class FormatsModel extends Model
{
    public static function getFormatName(int $formatID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT name FROM `formats` WHERE id = :formatID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':formatID', $formatID);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getFormatId(string $formatName)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT id FROM `formats` WHERE name = :formatName';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':formatName', $formatName);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}