<?php

namespace App\Models;

use Core\Model;
use PDOException;

class EventsReports extends Model
{
    public static function createReport($senderID, $eventID, $description)
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `events_reports` (sender_id, events_id, description) VALUES(:senderID, :eventID, :description)';

            $sth = $db->prepare($sql);
            $sth->execute([
                ':senderID' => $senderID,
                ':eventID' => $eventID,
                ':description' => $description
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}