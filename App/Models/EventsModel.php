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
                      location_city, location_street, formats_id, categories_id,
                      date_start, time_start) VALUES (:id, :title, :description, :location_country, :location_city, :location_street,
                                                       :formats_id, :categories_id, :date_start, :time_start)';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':id' => $eventData['eventID'],
                ':title' => $eventData['eventTitle'],
                ':description' => $eventData['eventDescription'],
                ':location_country' => $eventData['eventCountry'],
                ':location_city' => $eventData['eventCity'],
                ':location_street' => $eventData['eventStreet'],
                ':formats_id' => $eventData['eventFormat'],
                ':categories_id' => $eventData['eventCategory'],
                ':date_start' => $eventData['eventDate'],
                ':time_start' => $eventData['eventTime']
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
