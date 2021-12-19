<?php

namespace App\Models;

use Core\Model;
use PDOException;

class UsersReports extends Model
{
    private static string $table = 'users_reports';
    private static string $columnAuthorID = 'authors_id';
    private static string $columnEntityID = 'users_id';
    private static string $columnDescription = 'description';

    use \App\Traits\Models\EntityReportsTrait;
}