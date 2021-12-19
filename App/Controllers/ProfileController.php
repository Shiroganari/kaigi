<?php

namespace App\Controllers;

use App\Models\GroupsModel;
use Core\Controller;
use Core\View;

use App\Models\UsersModel;
use App\Models\UsersTopics;

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
        if ($_SESSION['status'] == TRIAL_STATUS) {
            header('Location: /complete-registration');
            exit;
        }

        $user = new UsersModel();

        $userID = $this->route_params['id'];
        $user = $user->getUserBy('id', $userID);
        $userData = [
            'username' => $user->getUsername(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'country' => $user->getCountry(),
            'city' => $user->getCity(),
            'description' => $user->getDescription()
        ];

        // Getting a list of user topics
        $userTopics = UsersTopics::getTopics($userID);
        $topicsList = TopicsView::renderTopics($userTopics, TEXT_INPUT);

        // Getting a list of user groups
        $userGroups = GroupsModel::getUserGroups($userID);
        $groupsList = GroupsView::renderGroups($userGroups);

        View::renderTemplate('profile/index','Kaigi | Профиль', 'profile',
            [
                'user' => $userData,
                'topicsList' => $topicsList,
                'groupsList' => $groupsList
            ]
        );
    }
}