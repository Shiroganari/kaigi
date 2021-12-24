<?php

namespace App\Views;

use Core\View;

class GroupsView extends View
{
    public static function renderGroup($group, $groupInfo)
    {
        ob_start();

        $groupData = [
            'id' => $group['id'],
            'title' => $group['title'],
            'description' => $group['description'],
            'country' => $group['location_country'],
            'city' => $group['location_city'],
            'categoryTitle' => $groupInfo['category_title'],
            'membersCount' => $groupInfo['members_count']
        ];

        View::render('component:group-item', ['groupData' => $groupData]);

        return ob_get_clean();
    }
}