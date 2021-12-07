<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\CategoriesModel;
use App\Models\GroupsModel;

class GroupsController extends Controller
{
    public function index()
    {
        $categories = CategoriesModel::getAll();

        View::render('Groups/index.php', ['categories' => $categories]);
    }

    // [Ajax Request]
    public function showGroups()
    {
        $groupsCategoryID = null;

        $categoryName = $this->post_params['groupsCategory'];
        $groupsTitle = $this->post_params['groupsTitle'];
        $groupsCountry = $this->post_params['groupsCountry'];
        $groupsCity = $this->post_params['groupsCity'];

        $groupsCategory = CategoriesModel::getCategoryId($categoryName);

        if ($groupsCategory) {
            $groupsCategoryID = $groupsCategory['id'];
        }

        $groups = groupsModel::getGroupsByFilters($groupsTitle, $groupsCountry, $groupsCity, $groupsCategoryID);

        foreach ($groups as $group) {
            $categoryInfo = CategoriesModel::getCategoryName($group['categories_id']);

            $groupData = [
                'groupID' => $group['id'],
                'groupTitle' => $group['title'],
                'groupDescription' => $group['description'],
                'groupCountry' => $group['location_country'],
                'groupCity' => $group['location_city'],
                'groupCategory' => $categoryInfo['name'],
            ];

            View::render('includes/components/group-item.php', ['groupData' => $groupData]);
        }
    }
}