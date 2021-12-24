<?php

namespace Core;

use PDO;
use PDOException;

class Model
{
    public static function get()
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('*');

            return $query->get($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getBy(string $column, string $value)
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

    public static function getLast()
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('id')
                ->max();

            return $query->first($query)["MAX(id)"];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getList(string $column = '*')
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select($column);

            $result = $query->get($query);

            $list = [];

            foreach ($result as $item) {
                foreach($item as $title) {
                    $list[] = $title;
                }
            }

            return $list;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function toList(array $array): array
    {
        $list = [];

        foreach ($array as $item) {
            foreach($item as $title) {
                $list[] = $title;
            }
        }

        return $list;
    }

    public static function count()
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('COUNT(*)');

            return $query->first($query)['COUNT(*)'];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}