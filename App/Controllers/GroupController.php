<?php

namespace App\Controllers;

use App\Models\EventsModel;
use App\Models\GroupsMembersModel;
use Core\Controller;
use Core\View;

use App\Models\CategoriesModel;
use App\Models\groupsModel;
use App\Models\groupsTopicsModel;

class GroupController extends Controller
{
    public function index()
    {
        View::render('Group/index.php');
    }

    public function groupCreationPage()
    {
        session_start();

        $categories = CategoriesModel::getAll();

        if (!isset($_SESSION['userID'])) {
            header('Location: /');
            exit;
        }

        View::render('Group/new-group.php', ['categories' => $categories]);
    }

    public function createGroup()
    {
        session_start();

        $userID = $_SESSION['userID'];

        $categoryName = $this->post_params['entity-category'];
        $categoryInfo = CategoriesModel::getCategoryId($categoryName);

        $groupID = rand(1, 1000);
        $groupTitle = $this->post_params['entity-title'];
        $groupCategoryId = $categoryInfo['id'];
        $groupDescription = $this->post_params['entity-description'];
        $groupCountry = $this->post_params['entity-country'];
        $groupCity = $this->post_params['entity-city'];
        $groupTopics = $this->post_params['entity-topics'];
        $groupOrganizer = $userID;

        $groupData = [
            'groupID' => $groupID,
            'groupTitle' => $groupTitle,
            'groupCategory' => $groupCategoryId,
            'groupDescription' => $groupDescription,
            'groupCountry' => $groupCountry,
            'groupCity' => $groupCity,
            'groupOrganizer' => $groupOrganizer
        ];

        var_dump($groupData);
        GroupsModel::newGroup($groupData);

        if (isset($groupTopics)) {
            GroupsTopicsModel::addGroupsTopics($groupID, $groupTopics);
        }

        GroupsMembersModel::newMember($groupID, $userID, 1);

        header('Location: /group/' . $groupID);
    }
}