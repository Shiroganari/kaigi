<?php

namespace App\Traits\Models;

use Core\Model;
use Core\QueryBuilder;

use PDOException;

trait EntityTopicsTrait
{
    public static function addTopics(int $entityID, array $topics): void
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table);

            for ($i = 0; $i < count($topics); $i++) {
                $query->insert(
                    [
                        static::$columnEntityID => $entityID,
                        static::$columnTopicTitle => $topics[$i]
                    ]
                );

                $query->execute($query);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getTopics(int $entityID)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select(static::$columnTopicTitle)
                ->where([static::$columnEntityID => $entityID]);

            return Model::toList($query->get($query));
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}