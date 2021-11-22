<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

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

        View::render('Profile/index.php');
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

        View::render('Profile/complete.php');
    }

    public function logoutAction()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /home/index');
    }
}