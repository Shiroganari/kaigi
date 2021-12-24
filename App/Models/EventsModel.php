<?php

namespace App\Models;

use Core\Model;

use Core\QueryBuilder;
use PDO;
use PDOException;

class EventsModel extends Model
{
    protected static string $table = 'events';

    private static string $columnTitle = 'title';
    private static string $columnDescription = 'description';
    private static string $columnCountry = 'location_country';
    private static string $columnCity = 'location_city';
    private static string $columnStreet = 'location_street';
    private static string $columnFormats = 'formats_id';
    private static string $columnCategories = 'categories_id';
    private static string $columnOrganizer = 'users_id';
    private static string $columnDateStart = 'date_start';

    private string $id;
    private string $title;
    private string $description;
    private string $country;
    private string $city;
    private string $street;
    private string $formatID;
    private string $categoryID;
    private string $organizerID;
    private string $dateStart;

    public static function newEvent(array $eventData): void
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->insert([
                    static::$columnTitle => $eventData['title'],
                    static::$columnDescription => $eventData['description'],
                    static::$columnCountry => $eventData['country'],
                    static::$columnCity => $eventData['city'],
                    static::$columnStreet => $eventData['street'],
                    static::$columnFormats => $eventData['format'],
                    static::$columnCategories => $eventData['categoryID'],
                    static::$columnOrganizer => $eventData['organizerID'],
                    static::$columnDateStart => $eventData['dateStart']
                ]);

            $query->execute($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getEventBy(string $column, string $value)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('*')
                ->where([$column => $value]);

            $event = $query->first($query);

            $this->id = $event['id'];
            $this->title = $event['title'];
            $this->description = $event['description'];
            $this->country = $event['location_country'];
            $this->city = $event['location_city'];
            $this->street = $event['location_street'];
            $this->formatID = $event['formats_id'];
            $this->categoryID = $event['categories_id'];
            $this->organizerID = $event['users_id'];
            $this->dateStart = $event['date_start'];

            return $this;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getUserEvents(int $userID, string $organizer, string $eventTitle)
    {
        try {
            $sql = "SELECT events.* FROM events
            INNER JOIN events_members ON events_members.events_id = events.id WHERE events_members.users_id = $userID";

            if ($organizer === 'true') {
                $sql .= " AND events.users_id = $userID";
            }

            if ($eventTitle) {
                $sql .= " AND events.title LIKE '%$eventTitle%'";
            }

            $sql .= ' ORDER BY events_members.date_creation DESC';

            $query = new QueryBuilder();
            return $query->get($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getEventInfo($event): array
    {
        return [
            'category_title' => CategoriesModel::getBy('id', $event['categories_id'])['title'],
            'members_count' => EventsMembersModel::countMembers($event['id'])
        ];
    }

    public function createData()
    {
        return [
            'id' => $this->getID(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'street' => $this->getStreet(),
            'dateStart' => $this->getDateStart(),
            'format' => $this->getFormatID(),
            'category' => $this->getCategoryID(),
            'membersCount' => EventsMembersModel::countMembers($this->id)
        ];
    }

    public static function getEventsByFilters($eventTitle, $eventCountry, $eventCity, $eventFormatID, $eventCategoryID)
    {
        try {
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

            $query = new QueryBuilder();
            return $query->get($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getFormatID(): int
    {
        return $this->formatID;
    }

    public function getCategoryID(): int
    {
        return $this->categoryID;
    }

    public function getOrganizerID(): int
    {
        return $this->organizerID;
    }

    public function getDateStart(): string
    {
        return $this->dateStart;
    }
}