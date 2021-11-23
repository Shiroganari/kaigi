<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class UsersTopics extends Model
{
    // Add user topics to the table
    public static function addUsersTopics(int $id, array $topics): void
    {
        try {
            $db = static::getDB();
            $topicsCount = count($topics);

            // If a user has selected at least one topic
            if (isset($topicsCount)) {
                for ($i = 0; $i < $topicsCount; $i++) {
                    $sql = 'INSERT INTO users_topics (users_id, topic_name) VALUES (?, ?);';
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$id, $topics[$i]]);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Get user topics from the table
    public static function getUserTopics($userID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT topic_name FROM users_topics WHERE users_id = ?;';
            $stmt = $db->prepare($sql);
            $stmt->execute([$userID]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 'ERROR';
        }
    }
}