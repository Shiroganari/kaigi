<?php

namespace App\Models;

use Core\Model;

use Core\QueryBuilder;
use PDO;
use PDOException;

class TopicsModel extends Model
{
    protected static string $table = 'topics';

    private static string $columnID = 'id';
    private static string $columnTopicTitle = 'title';
    private static string $columnCategoryID = 'categories_id';

    public int $id;
    public int $categoryID;
    public string $topicTitle;

    public static function getTopicsByCategory(int $categoryID)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select(static::$columnTopicTitle)
                ->where([static::$columnCategoryID => $categoryID]);

            return Model::toList($query->get($query));
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}