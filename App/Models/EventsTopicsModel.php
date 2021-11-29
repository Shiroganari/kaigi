<?php

namespace App\Models;

use Core\Model;

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
}