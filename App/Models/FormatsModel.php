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
}