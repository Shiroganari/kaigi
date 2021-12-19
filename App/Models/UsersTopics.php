<?php

namespace App\Models;

use Core\Model;

class UsersTopics extends Model
{
    protected static string $table = 'users_topics';

    private static string $columnID = 'id';
    private static string $columnEntityID = 'users_id';
    private static string $columnTopicTitle = 'topics_title';

    use \App\Traits\Models\EntityTopicsTrait;
}