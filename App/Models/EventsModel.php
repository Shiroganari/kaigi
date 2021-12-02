<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class EventsModel extends Model
{
    public static function newEvent(array $eventData): void
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `events` (id, title, description, location_country, 
                      location_city, location_street, formats_id, categories_id, users_id,
                      date_start) VALUES (:id, :title, :description, :locationCountry, :locationCity, :locationStreet,
                                                       :formatsID, :categoriesID, :usersID, :dateStart)';
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
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllEvents()
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM events;';
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getEventInfoByTitle(string $eventTitle)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM events WHERE title = :eventTitle';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':eventTitle', $eventTitle);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getEventInfoById(int $eventID)
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
            return false;
        }
    }

    public static function getEventsByFilters($eventTitle, $eventCountry, $eventCity, $eventFormatID, $eventCategoryID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM events WHERE event_status="1"';

            if ($eventTitle) {
                $sql .= " AND title LIKE '%$eventTitle%'";
            }

            if ($eventFormatID) {
                $sql .= " AND formats_id = $eventFormatID";
            } else {
                $sql .= ' AND (formats_id = 1 OR formats_id = 2)';
            }

            if ($eventCountry && $eventFormatID == 2) {
                $sql .= " AND location_country = '$eventCountry'";
            }

            if ($eventCity && $eventFormatID == 2) {
                $sql .= " AND location_city = '$eventCity'";
            }

            if ($eventCategoryID) {
                $sql .= " AND categories_id = $eventCategoryID";
            }

            $sql .= ' ORDER BY date_creation DESC';

            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
