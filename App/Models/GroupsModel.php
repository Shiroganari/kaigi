<?php

namespace App\Models;

use Core\Model;

use PDO;
use PDOException;

class GroupsModel extends Model
{
    public static function newGroup(array $groupData): void
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `groups` (id, title, description, categories_id, location_country, 
                      location_city, users_id)
                      VALUES (:id, :title, :description, :categoriesID,
                              :locationCountry, :locationCity, :usersID)';
            $sth = $db->prepare($sql);
            $sth->execute([
                ':id' => $groupData['groupID'],
                ':title' => $groupData['groupTitle'],
                ':description' => $groupData['groupDescription'],
                ':categoriesID' => $groupData['groupCategory'],
                ':locationCountry' => $groupData['groupCountry'],
                ':locationCity' => $groupData['groupCity'],
                ':usersID' => $groupData['groupOrganizer']
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getGroupInfoById(int $groupID)
    {
        try {
            $db = static::getDB();

            $sql = 'SELECT * FROM `groups` WHERE id = :groupID';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':groupID', $groupID);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getGroupsByFilters($groupTitle, $groupCountry, $groupCity, $groupCategoryID)
    {
        try {
            $db = static::getDB();

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

            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}