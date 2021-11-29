<?php

namespace App\Models;

use Core\Model;

use PDOException;

class EventsModel extends Model
{
    public static function newEvent(array $eventData): void
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `events` (id, title, description, location_country, 
                      location_city, location_street, formats_id, categories_id, users_id,
                      date_start, time_start) VALUES (:id, :title, :description, :locationCountry, :locationCity, :locationStreet,
                                                       :formatsID, :categoriesID, :usersID, :dateStart, :timeStart)';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':id' => $eventData['eventID'],
                ':title' => $eventData['eventTitle'],
                ':description' => $eventData['eventDescription'],
                ':locationCountry' => $eventData['eventCountry'],
                ':locationCity' => $eventData['eventCity'],
                ':locationStreet' => $eventData['eventStreet'],
                ':formatsID' => $eventData['eventFormat'],
                ':categoriesID' => $eventData['eventCategory'],
                ':usersID' => $eventData['eventOrganizer'],
                ':dateStart' => $eventData['eventDate'],
                ':timeStart' => $eventData['eventTime']
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getEventInfo(int $eventID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM events WHERE id = :eventID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':eventID', $eventID);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
