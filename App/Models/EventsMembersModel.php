<?php

namespace App\Models;

use Core\Model;
use Core\QueryBuilder;

use PDOException;

class EventsMembersModel extends Model
{
    protected static string $table = 'events_members';
    private static string $columnEntityID = 'events_id';
    private static string $columnUserID = 'users_id';
    private static string $columnRoleID = 'roles_id';

    use \App\Traits\Models\EntityMembersTrait;

    public static function getEventMembers(int $eventID)
    {
        try {
            $sql = "SELECT users.* FROM users 
                INNER JOIN events_members ON events_members.events_id = $eventID WHERE events_members.users_id = users.id
                ORDER BY events_members.date_creation DESC";

            return (new QueryBuilder())->get($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}