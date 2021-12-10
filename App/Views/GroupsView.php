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
            $categoryInfo = CategoriesModel::getCategoryName($group['categories_id']);
            $groupMembers = GroupsMembersModel::countGroupMembers($group['id']);

            $groupData = [
                'groupID' => $group['id'],
                'groupTitle' => $group['title'],
                'groupDescription' => $group['description'],
                'groupCountry' => $group['location_country'],
                'groupCity' => $group['location_city'],
                'groupCategory' => $categoryInfo['name'],
                'groupMembersCount' => $groupMembers['COUNT(*)']
            ];

            View::render('component:group-item', ['groupData' => $groupData]);
        }

        return ob_get_clean();
    }
}