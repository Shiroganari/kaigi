<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\GroupsMembersModel;
use App\Models\GroupsTopicsModel;
use App\Models\GroupsModel;
use App\Models\CategoriesModel;
use App\Models\UsersModel;

use App\Views\CategoriesView;
use App\Views\TopicsView;
use App\Views\UsersView;

class GroupController extends Controller
{
    public function index()
    {
        session_start();

        $groupID = $this->route_params['id'];

        // Getting group data
        $group = new GroupsModel();
        $group = $group->getGroupBy('id', $groupID);
        $groupData = $group->createData();
        $groupCategory = CategoriesModel::getBy('id', $groupData['categoryID']);

        // Getting a list of group topics
        $groupTopics = GroupsTopicsModel::getTopics($groupID);
        $topicsList = null;

        if ($groupTopics) {
            $topicsList = TopicsView::renderTopics($groupTopics, 'text');
        }

        // Getting data about event's organizer
        $organizer = new UsersModel();
        $organizer = $organizer->getUserBy('id', $group->getOrganizerID());
        $organizerData = $organizer->createData();

        $userID = null;
        $isMember = false;

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            $isMember = GroupsMembersModel::isMember($groupID, $userID);
        }

        // Getting a list of group members
        $organizerPrivileges = $userID == $group->getOrganizerID();
        $groupMembers = GroupsMembersModel::getGroupMembers($groupID);
        $membersList = UsersView::renderUser($groupMembers, $organizerPrivileges);

        ob_start();
        View::render('component:report-button',
            [
                'reportType' => 'group',
                'nickname' => $groupData['title'],
                'userID' => $userID
            ]
        );
        $reportButton = ob_get_clean();

        $groupTitle = $groupData['title'];
        View::renderTemplate('group/index', "Kaigi | $groupTitle", 'groups',
            [
                'groupData' => $groupData,
                'organizer' => $organizerData,
                'category' => $groupCategory['title'],
                'topicsList' => $topicsList,
                'userID' => $userID,
                'isMember' => $isMember,
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

        $categories = CategoriesModel::getList('title');
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
        $category = CategoriesModel::getBy('title', $categoryName);

        $groupTitle = $this->post_params['entity-title'];
        $groupCategoryId = $category['id'];
        $groupDescription = $this->post_params['entity-description'];
        $groupCountry = $this->post_params['entity-country'];
        $groupCity = $this->post_params['entity-city'];
        $groupTopics = $this->post_params['entity-topics'];
        $groupOrganizer = $userID;

        $groupData = [
            'title' => $groupTitle,
            'category' => $groupCategoryId,
            'description' => $groupDescription,
            'country' => $groupCountry,
            'city' => $groupCity,
            'organizer' => $groupOrganizer
        ];

        GroupsModel::newGroup($groupData);
        $groupID = GroupsModel::getLast();

        if (isset($groupTopics)) {
            GroupsTopicsModel::addTopics($groupID, $groupTopics);
        }

        GroupsMembersModel::newMember($groupID, $userID, ORGANIZER);

        header('Location: /group/' . $groupID);
    }

    public function groupParticipation()
    {
        $userID = (int)$this->post_params['userID'];
        $groupID = (int)$this->post_params['entityID'];

        if (GroupsMembersModel::isMember($groupID, $userID)) {
            GroupsMembersModel::removeMember($groupID, $userID);
            echo json_encode('Left');
            exit;
        }

        GroupsMembersModel::newMember($groupID, $userID, MEMBER);
        echo json_encode('Join');
    }

    public function kickMember()
    {
        $userID = $this->post_params['userID'];
        $groupID = $this->post_params['entityID'];

        GroupsMembersModel::removeMember($groupID, $userID);
        echo json_encode('The user has been kicked');
    }
}