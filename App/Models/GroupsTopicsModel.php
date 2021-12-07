<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class GroupsTopicsModel extends Model
{
    public static function addGroupsTopics(int $groupID, array $topics): void
    {
        try {
            $db = static::getDB();

            $topicsCount = count($topics);
            $sql = 'INSERT INTO `groups_topics` (groups_id, topics_name) VALUES (:groupID, :topicsName)';
            $stmt = $db->prepare($sql);

            for ($i = 0; $i < $topicsCount; $i++) {
                $stmt->execute([
                    ':groupID' => $groupID,
                    ':topicsName' => $topics[$i]
                ]);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getGroupTopics(int $groupID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT topics_name FROM `groups_topics` WHERE groups_id = :groupID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':groupID', $groupID);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}