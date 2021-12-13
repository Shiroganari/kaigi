<?php

namespace App\Controllers;

use App\Views\UsersView;
use Core\Controller;
use Core\View;

use App\Models\GroupsMembersModel;
use App\Models\GroupsTopicsModel;
use App\Models\GroupsModel;
use App\Models\CategoriesModel;
use App\Models\UsersModel;

use App\Views\CategoriesView;
use App\Views\TopicsView;

class GroupController extends Controller
{
    public function index()
    {
        session_start();

        $groupID = $this->route_params['id'];
        $groupData = GroupsModel::getGroupInfoById($groupID);
        $groupTitle = $groupData['title'];
        $groupTopics = GroupsTopicsModel::getGroupTopics($groupID);
        $groupMembersCount = GroupsMembersModel::countGroupMembers($groupID);
        $groupMembersID = GroupsMembersModel::getAllMembers($groupID);
        $groupOrganizer = UsersModel::getUserById($groupData['users_id']);
        $categoryName = CategoriesModel::getCategoryName($groupData['categories_id']);

        $userID = null;
        $user = null;
        $isMember = false;
        $groupMembers = [];

        foreach($groupMembersID as $value) {
            $groupMembers[] = UsersModel::getUserById($value['users_id']);
        }

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        }

        if ($userID) {
            $user = GroupsMembersModel::getUser($groupID, $userID);
        }

        if ($user) {
            $isMember = true;
        }

        $topicsList = TopicsView::renderTopics($groupTopics, 'text');
        $membersList = UsersView::renderUser($groupMembers);

        ob_start();
        View::render('component:report-button',
            [
                'reportType' => 'group',
                'nickname' => $groupData['title'],
                'userID' => $userID
            ]
        );
        $reportButton = ob_get_clean();

        View::renderTemplate('group/index', "Kaigi | $groupTitle", 'groups',
            [
                'groupData' => $groupData,
                'groupCategory' => $categoryName,
                'organizerName' => $groupOrganizer,
                'topicsList' => $topicsList,
                'userID' => $userID,
                'isMember' => $isMember,
                'groupMembersCount' => $groupMembersCount['COUNT(*)'],
                'membersList' => $membersList,
                'reportButton' => $reportButton
            ]
        );
    }

    public function groupCreationPage()
    {
        session_start();

        if (!isset($_SESSION['userID'])) {
            header('Location: /');
            exit;
        }

        $categories = CategoriesModel::getAll();
        $categoriesList = CategoriesView::renderCategories($categories);

        View::renderTemplate('group/new-group', 'Kaigi | Создание новой группы', 'groups',
            [
                'categoriesList' => $categoriesList
            ]
        );
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