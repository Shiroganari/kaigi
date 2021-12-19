<?php

namespace App\Models;

use Core\Model;

class EventsTopicsModel extends Model
{
    protected static string $table = 'events_topics';

    private static string $columnID = 'id';
    private static string $columnEntityID = 'events_id';
    private static string $columnTopicTitle = 'topics_title';

    use \App\Traits\Models\EntityTopicsTrait;
}