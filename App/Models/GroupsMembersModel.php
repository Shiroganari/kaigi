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

    public static function getUser(int $groupID, int $userID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM `groups_members` WHERE groups_id = :groupID AND users_id = :userID';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':groupID' => $groupID,
                ':userID' => $userID,
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getAllMembers(int $groupID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT users_id FROM `groups_members` WHERE groups_id = :groupID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':groupID', $groupID);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function removeMember(int $groupID, int $userID): void
    {
        try {
            $db = static::getDB();

            $sql = 'DELETE FROM `groups_members` WHERE groups_id = :groupID AND users_id = :userID';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':groupID' => $groupID,
                ':userID' => $userID
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function countGroupMembers(int $groupID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT COUNT(*) FROM `groups_members` WHERE groups_id = :groupID';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':groupID' => $groupID,
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getUserGroups(int $userID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM `groups_members` WHERE users_id = :userID';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':userID' => $userID,
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}