<?php

namespace App\Models;

use Core\Model;
use Core\QueryBuilder;

use PDOException;

class GroupsMembersModel extends Model
{
    protected static string $table = 'groups_members';

    private static string $columnEntityID = 'groups_id';
    private static string $columnUserID = 'users_id';
    private static string $columnRoleID = 'roles_id';

    use \App\Traits\Models\EntityMembersTrait;

    public static function getGroupMembers(int $groupID)
    {
        try {
            $sql = "SELECT users.* FROM users 
                INNER JOIN groups_members ON groups_members.groups_id = $groupID WHERE groups_members.users_id = users.id
                ORDER BY groups_members.date_creation DESC";

            return (new QueryBuilder())->get($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}