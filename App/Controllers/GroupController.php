<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\GroupsMembersModel;
use App\Models\GroupsTopicsModel;
use App\Models\GroupsModel;
use App\Models\CategoriesModel;
use App\Models\UsersModel;

class GroupController extends Controller
{
    public function index()
    {
        session_start();

        $groupID = $this->route_params['id'];
        $groupData = GroupsModel::getGroupInfoById($groupID);
        $categoryName = CategoriesModel::getCategoryName($groupData['categories_id']);
        $groupOrganizer = UsersModel::getUserById($groupData['users_id']);
        $groupTopics = GroupsTopicsModel::getGroupTopics($groupID);
        $groupMembers = GroupsMembersModel::countGroupMembers($groupID);
        $groupMembersID = GroupsMembersModel::getAllMembers($groupID);

        $userID = 0;
        $user = null;
        $isMember = false;

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        }

        if ($userID) {
            $user = GroupsMembersModel::getUser($groupID, $userID);
        }

        if ($user) {
            $isMember = true;
        }

        View::render('Group/index.php', [
            'groupData' => $groupData,
            'groupCategory' => $categoryName,
            'organizerName' => $groupOrganizer,
            'groupTopics' => $groupTopics,
            'userID' => $userID,
            'isMember' => $isMember,
            'groupMembersCount' => $groupMembers['COUNT(*)']
        ]);
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

        GroupsModel::newGroup($groupData);

        if (isset($groupTopics)) {
            GroupsTopicsModel::addGroupsTopics($groupID, $groupTopics);
        }

        GroupsMembersModel::newMember($groupID, $userID, 1);

        header('Location: /group/' . $groupID);
    }

    public function groupParticipation()
    {
        $userID = (int)$this->post_params['userID'];
        $groupID = (int)$this->post_params['entityID'];
        $roleID = 2; // Участник

        if (GroupsMembersModel::getUser($groupID, $userID)) {
            GroupsMembersModel::removeMember($groupID, $userID);
            echo json_encode('Left');
            exit;
        }

        GroupsMembersModel::newMember($groupID, $userID, $roleID);
        echo json_encode('Join');
    }
}