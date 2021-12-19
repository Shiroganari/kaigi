<?php

namespace App\Traits\Models;

use Core\QueryBuilder;
use PDOException;

trait EntityMembersTrait
{
    public static function newMember(int $entityID, int $userID, int $roleID): void
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->insert(
                    [
                        static::$columnEntityID => $entityID,
                        static::$columnUserID => $userID,
                        static::$columnRoleID => $roleID
                    ]
                );

            $query->execute($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function removeMember(int $entityID, int $userID): void
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->where(
                    [
                        static::$columnEntityID => $entityID,
                        static::$columnUserID => $userID
                    ]
                )
                ->delete();

            $query->execute($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function isMember(int $entityID, int $userID): bool
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('*')
                ->where(
                    [
                        static::$columnEntityID => $entityID,
                        static::$columnUserID => $userID
                    ]
                );

            if ($query->first($query) != []) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function countMembers(int $entityID)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('COUNT(*)')
                ->where([static::$columnEntityID => $entityID]);

            return $query->first($query)['COUNT(*)'];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}