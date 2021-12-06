<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class GroupsMembersModel extends Model
{
    public static function newMember(int $groupID, int $userID, int $roleID): void
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `groups_members` (groups_id, users_id, roles_id) VALUES (:groupID, :userID, :roleID)';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':groupID' => $groupID,
                ':userID' => $userID,
                ':roleID' => $roleID
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}