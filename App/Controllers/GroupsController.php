<?php

namespace App\Controllers;

use App\Views\CategoriesView;
use Core\Controller;
use Core\View;

use App\Models\CategoriesModel;
use App\Models\GroupsModel;

use App\Views\GroupsView;

class GroupsController extends Controller
{
    public function index()
    {
        session_start();

        $categories = CategoriesModel::getAll();
        $categoriesList = CategoriesView::renderCategories($categories);

        View::renderTemplate('groups/index','Kaigi | Группы', 'groups',
            [
                'categoriesList' => $categoriesList
            ]
        );
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

        echo GroupsView::renderGroups($groups);
    }
}