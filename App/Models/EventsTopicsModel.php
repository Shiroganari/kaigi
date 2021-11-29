<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class EventsTopicsModel extends Model
{
    public static function addEventsTopics(int $eventID, array $topics): void
    {
        try {
            $db = static::getDB();

            $topicsCount = count($topics);
            $sql = 'INSERT INTO `events_topics` (events_id, topics_name) VALUES (:eventID, :topicsName)';
            $stmt = $db->prepare($sql);

            for ($i = 0; $i < $topicsCount; $i++) {
                $stmt->execute([
                    ':eventID' => $eventID,
                    ':topicsName' => $topics[$i]
                ]);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getEventTopics(int $eventID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT topics_name FROM `events_topics` WHERE events_id = :eventID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':eventID', $eventID);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}