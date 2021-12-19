<?php

namespace App\Models;

use Core\Model;
use Core\QueryBuilder;

use PDOException;

class CategoriesModel extends Model
{
    protected static string $table = 'categories';

    private static string $columnID = 'id';
    private static string $columnTitle = 'title';

    public int $id;
    public string $title;
}