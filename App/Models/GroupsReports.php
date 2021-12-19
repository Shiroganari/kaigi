<?php

namespace App\Models;

use Core\Model;
use PDOException;

class GroupsReports extends Model
{
    private static string $table = 'groups_reports';
    private static string $columnAuthorID = 'authors_id';
    private static string $columnEntityID = 'groups_id';
    private static string $columnDescription = 'description';

    use \App\Traits\Models\EntityReportsTrait;
}