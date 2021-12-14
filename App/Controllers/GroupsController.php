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

        View::renderTemplate('groups/index', 'Kaigi | Группы', 'groups',
            [
                'categoriesList' => $categoriesList
            ]
        );
    }

    public function myGroupsPage()
    {
        session_start();

        if (!isset($_SESSION['userID'])) {
            header('Location: /login');
        }

        View::renderTemplate('groups/my-groups', 'Kaigi | Мои группы', 'groups');
    }

    // [Ajax Request]
    public function showGroups()
    {
        session_start();

        $userID = null;

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        }

        $groupsCategoryID = null;
        $groupsTitle = null;
        $groupsCountry = null;
        $groupsCity = null;
        $myGroups = null;
        $isOrganizer = false;

        if (isset($this->post_params['groupsCategory'])) {
            $categoryName = $this->post_params['groupsCategory'];
            $groupsCategory = CategoriesModel::getCategoryId($categoryName);

            if ($groupsCategory) {
                $groupsCategoryID = $groupsCategory['id'];
            }
        }

        if (isset($this->post_params['groupsTitle'])) {
            $groupsTitle = $this->post_params['groupsTitle'];
        }

        if (isset($this->post_params['groupsCountry'])) {
            $groupsCountry = $this->post_params['groupsCountry'];
        }

        if (isset($this->post_params['groupsCity'])) {
            $groupsCity = $this->post_params['groupsCity'];
        }

        if (isset($this->post_params['myGroups'])) {
            $myGroups = true;
        }

        if (isset($this->post_params['isOrganizer'])) {
            $isOrganizer = $this->post_params['isOrganizer'];
        }

        $groups = null;

        if ($myGroups) {
            $groups = GroupsModel::getUserGroups($userID, $isOrganizer, $groupsTitle);
        } else {
            $groups = groupsModel::getGroupsByFilters($groupsTitle, $groupsCountry, $groupsCity, $groupsCategoryID);
        }

        echo GroupsView::renderGroups($groups);
    }
}