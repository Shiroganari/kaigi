<?php

namespace App\Models;

use Core\Model;

use Core\QueryBuilder;
use PDO;
use PDOException;

class FormatsModel extends Model
{
    protected static string $table = 'formats';

    public int $id;
    public string $title;

    public static function getFormatBy(string $column, string $value)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('*')
                ->where([$column => $value]);

            return $query->first($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}