<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class UsersTopics extends Model
{
    // Add user topics into the database
    public static function addUsersTopics(int $userID, array $topics): void
    {
        try {
            $db = static::getDB();

            $topicsCount = count($topics);
            $sql = 'INSERT INTO users_topics (users_id, topic_name) VALUES (:userID, :topic)';

            for ($i = 0; $i < $topicsCount; $i++) {
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':userID'  => $userID,
                    ':topic'   => $topics[$i]
                ]);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Get user topics from the database
    public static function getUserTopics(int $userID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT topic_name FROM users_topics WHERE users_id = :userID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':userID', $userID);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}