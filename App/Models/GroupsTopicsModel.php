<?php

namespace App\Models;

use Core\Model;

class GroupsTopicsModel extends Model
{
    protected static string $table = 'groups_topics';

    private static string $columnID = 'id';
    private static string $columnEntityID = 'groups_id';
    private static string $columnTopicTitle = 'topics_title';

    use \App\Traits\Models\EntityTopicsTrait;
}