<?php

namespace App\Models;

use Core\Model;
use PDOException;

class GroupsReports extends Model
{
    public static function createReport($senderID, $groupID, $description)
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `groups_reports` (sender_id, groups_id, description) VALUES(:senderID, :groupID, :description)';

            $sth = $db->prepare($sql);
            $sth->execute([
                ':senderID' => $senderID,
                ':groupID' => $groupID,
                ':description' => $description
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}