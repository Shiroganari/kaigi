<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class UsersTopics extends Model
{
    public static function addUsersTopics($id, $topics)
    {
        try {
            $db = static::getDB();

            if (!isset($topicsCount)) {
                return 'No topics';
            }

            $topicsCount = count($topics);

            for ($i = 0; $i < $topicsCount; $i++) {
                $sql = 'INSERT INTO users_topics (users_id, topic_name) VALUES (?, ?);';
                $stmt = $db->prepare($sql);
                $stmt->execute([$id, $topics[$i]]);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}