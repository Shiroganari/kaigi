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
}