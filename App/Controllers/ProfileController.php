<?php

namespace App\Controllers;

use App\Models\GroupsModel;
use Core\Controller;
use Core\View;

use App\Models\TopicsModel;
use App\Models\UsersModel;
use App\Models\UsersTopics;
use App\Models\GroupsMembersModel;

class ProfileController extends Controller
{
    public function index()
    {
        session_start();

        if (!isset($_SESSION['status'])) {
            header('Location: /');
            exit;
        }

        if ($_SESSION['status'] == 1) {
            header('Location: /profile/completeRegistration');
            exit;
        }

        $user = UsersModel::getUser($_SESSION['email']);
        $userID = $_SESSION['userID'];
        $userTopics = UsersTopics::getUserTopics($userID);
        $userGroups = GroupsMembersModel::getUserGroups($userID);
        $groups = [];

        foreach ($userGroups as $group) {
            $groups[] = GroupsModel::getGroupInfoById($group['groups_id']);
        }

        View::render('Profile/index.php',
            [
                'user' => $user,
                'userTopics' => $userTopics,
                'userGroups' => $userGroups,
                'groups' => $groups
            ]);
    }

    public function completeRegistration()
    {
        session_start();

        if (!isset($_SESSION['status'])) {
            header('Location: /');
            exit;
        }

        if (!$_SESSION['status'] == 1) {
            header('Location: /profile');
            exit;
        }

        $topics = TopicsModel::getAll();

        View::render('Profile/complete.php',
            [
                'topics' => $topics
            ]
        );
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /');
    }
}