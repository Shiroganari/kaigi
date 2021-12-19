<?php

namespace App\Models;

use Core\Model;
use Core\QueryBuilder;
use PDOException;

class EventsReports extends Model
{
    private static string $table = 'events_reports';
    private static string $columnAuthorID = 'authors_id';
    private static string $columnEntityID = 'events_id';
    private static string $columnDescription = 'description';

   use \App\Traits\Models\EntityReportsTrait;
}