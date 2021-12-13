<?php

namespace App\Models;

use Core\Model;
use PDOException;

class UsersReports extends Model
{
    public static function createReport($senderID, $userID, $description)
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `users_reports` (sender_id, users_id, description) VALUES(:senderID, :userID, :description)';

            $sth = $db->prepare($sql);
            $sth->execute([
                ':senderID' => $senderID,
                ':userID' => $userID,
                ':description' => $description
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}