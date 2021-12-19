<?php

namespace App\Models;

use Core\Model;

use Core\QueryBuilder;
use PDO;
use PDOException;

class GroupsModel extends Model
{
    protected static string $table = 'groups';

    private static string $columnID = 'id';
    private static string $columnTitle = 'title';
    private static string $columnDescription = 'description';
    private static string $columnCountry = 'location_country';
    private static string $columnCity = 'location_city';
    private static string $columnCategories = 'categories_id';
    private static string $columnOrganizer = 'users_id';
    private static string $columnDateCreation = 'date_creation';

    private int $id;

    private string $title;
    private string $description;
    private string $country;
    private string $city;
    private string $categoryID;
    private string $organizerID;
    private string $dateCreation;

    public static function newGroup(array $groupData): void
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->insert(
                    [
                        static::$columnTitle => $groupData['title'],
                        static::$columnDescription => $groupData['description'],
                        static::$columnCategories => $groupData['category'],
                        static::$columnCountry=> $groupData['country'],
                        static::$columnCity => $groupData['city'],
                        static::$columnOrganizer => $groupData['organizer'],
                    ]
                );

            $query->execute($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createData()
    {
        return [
            'id' => $this->id,
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'categoryID' => $this->getCategoryID(),
            'organizerID' => $this->getOrganizerID(),
            'dateCreation' => $this->getDateCreation(),
            'membersCount' => GroupsMembersModel::countMembers($this->id)
        ];
    }

    public function getGroupBy(string $column, string $value)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('*')
                ->where([$column => $value]);

            $group = $query->first($query);

            $this->id = $group['id'];
            $this->title = $group['title'];
            $this->description = $group['description'];
            $this->country = $group['location_country'];
            $this->city = $group['location_city'];
            $this->categoryID = $group['categories_id'];
            $this->organizerID = $group['users_id'];
            $this->dateCreation = $group['date_creation'];

            return $this;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getUserGroups(int $userID, string $organizer = '', string $groupTitle = '')
    {
        try {
            $sql = "SELECT groups.* FROM groups 
                INNER JOIN groups_members ON groups_members.users_id = $userID WHERE groups_members.groups_id = groups.id";

            if ($organizer === 'true') {
                $sql .= " AND groups.users_id = $userID";
            }

            if ($groupTitle) {
                $sql .= " AND groups.title LIKE '%$groupTitle%'";
            }

            $sql .= ' ORDER BY groups_members.date_creation DESC';

            return (new QueryBuilder())->get($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getGroupsByFilters($groupTitle, $groupCountry, $groupCity, $groupCategoryID)
    {
        try {
            $sql = 'SELECT * FROM groups WHERE group_status="1"';

            if ($groupTitle) {
                $sql .= " AND title LIKE '%$groupTitle%'";
            }

            if ($groupCountry) {
                $sql .= " AND location_country = '$groupCountry'";
            }

            if ($groupCity) {
                $sql .= " AND location_city = '$groupCity'";
            }

            if ($groupCategoryID) {
                $sql .= " AND categories_id = $groupCategoryID";
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

    public function getCategoryID(): int
    {
        return $this->categoryID;
    }

    public function getOrganizerID(): int
    {
        return $this->organizerID;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }
}