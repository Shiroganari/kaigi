<?php

namespace App\Controllers;

use App\Models\TopicsModel;
use Core\Controller;
use Core\View;
use App\Models\User;
use App\Models\UsersTopics;

class Profile extends Controller
{
    public function indexAction()
    {
        session_start();

        if (!isset($_SESSION['status'])) {
            header('Location: /');
            exit;
        }

        if ($_SESSION['status'] == 1) {
            header('Location: /profile/complete');
            exit;
        }

        $args['user'] = User::getUser($_SESSION['email']);
        $args['user_topics'] = UsersTopics::getUserTopics($_SESSION['userID']);

        View::render('Profile/index.php', $args);
    }

    public function completeAction()
    {
        session_start();

        if (!isset($_SESSION['status'])) {
            header('Location: /');
            exit;
        }

        if (!$_SESSION['status'] == 1) {
            header('Location: /profile/index');
            exit;
        }

        $args['topics'] = TopicsModel::getAll();

        View::render('Profile/complete.php', $args);
    }

    public function logoutAction()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /home/index');
    }
}