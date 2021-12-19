<?php

namespace App\Traits\Models;

use Core\QueryBuilder;
use PDOException;

trait EntityReportsTrait
{
    public static function createReport(int $authorID, int $entityID, string $description)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->insert(
                    [
                        static::$columnAuthorID => $authorID,
                        static::$columnEntityID => $entityID,
                        static::$columnDescription => $description
                    ]
                );

            $query->execute($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}