<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\TopicsModel;
use App\Models\UsersModel;
use App\Models\UsersTopics;

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
        $userTopics = UsersTopics::getUserTopics($_SESSION['userID']);

        View::render('Profile/index.php',
            [
                'user' => $user,
                'userTopics' => $userTopics
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