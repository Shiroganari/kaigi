<?php

namespace App\Views;

use Core\View;

use App\Models\CategoriesModel;
use App\Models\GroupsMembersModel;

class GroupsView extends View
{
    public static function renderGroups($groups)
    {
        ob_start();

        foreach ($groups as $group) {
            $categoryInfo = CategoriesModel::getBy('id', $group['categories_id']);
            $groupMembersCount = GroupsMembersModel::countMembers($group['id']);

            $groupData = [
                'id' => $group['id'],
                'title' => $group['title'],
                'description' => $group['description'],
                'country' => $group['location_country'],
                'city' => $group['location_city'],
                'category' => $categoryInfo['title'],
                'membersCount' => $groupMembersCount
            ];

            View::render('component:group-item', ['groupData' => $groupData]);
        }

        return ob_get_clean();
    }
}