<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class EventsMembersModel extends Model
{
    public static function newMember(int $eventID, int $userID, int $roleID): void
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `events_members` (events_id, users_id, roles_id) VALUES (:eventID, :userID, :roleID)';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':eventID' => $eventID,
                ':userID' => $userID,
                ':roleID' => $roleID
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function removeMember(int $eventID, int $userID): void
    {
        try {
            $db = static::getDB();

            $sql = 'DELETE FROM `events_members` WHERE events_id = :eventID AND users_id = :userID';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':eventID' => $eventID,
                ':userID' => $userID
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getUser(int $eventID, int $userID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM `events_members` WHERE events_id = :eventID AND users_id = :userID';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':eventID' => $eventID,
                ':userID' => $userID,
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function countEventMembers(int $eventID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT COUNT(*) FROM `events_members` WHERE events_id = :eventID';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':eventID' => $eventID,
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}