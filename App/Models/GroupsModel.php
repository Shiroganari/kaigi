<?php

namespace App\Models;

use Core\Model;

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
}