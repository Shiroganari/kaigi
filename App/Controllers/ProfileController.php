<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\UsersModel;
use App\Models\UsersTopics;
use App\Models\GroupsModel;
use App\Models\GroupsMembersModel;

use App\Views\GroupsView;
use App\Views\TopicsView;

class ProfileController extends Controller
{
    public function index()
    {
        session_start();

        // If a user is not logged in
        if (!isset($_SESSION['status'])) {
            header('Location: /');
            exit;
        }

        // If a user has not completed the registration process
        if ($_SESSION['status'] == 1) {
            header('Location: /complete-registration');
            exit;
        }

        $userID = $this->route_params['id'];
        $user = UsersModel::getUserById($userID);
        $userTopics = UsersTopics::getUserTopics($userID);
        $userGroups = GroupsMembersModel::getUserGroups($userID);
        $groups = [];

        foreach ($userGroups as $group) {
            $groups[] = GroupsModel::getGroupInfoById($group['groups_id']);
        }

        // Getting a list of user topics
        $topicsList = TopicsView::renderTopics($userTopics, 'text');

        // Getting a list of user groups
        $groupsList = GroupsView::renderGroups($groups);

        View::renderTemplate('profile/index','Kaigi | Профиль', 'profile',
            [
                'user' => $user,
                'topicsList' => $topicsList,
                'groupsList' => $groupsList
            ]
        );
    }
}