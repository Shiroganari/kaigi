<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\User;

class Login extends Controller
{
    public function indexAction()
    {
        session_start();

        if (isset($_SESSION['active'])) {
            header('Location: /profile/index');
            exit;
        }

        View::render('Login/index.php');
    }

    public function signinAction()
    {
        $email = $this->post_params['email'];
        $password = $this->post_params['pass'];
        $user = $this->validateUser($email, $password);

        if ($user == 'No Found') {
            View::render('Login/index.php');
            echo 'Пользователь не был найден.';
            exit;
        }

        session_start();

        $_SESSION['active'] = true;
        $_SESSION['status'] = $user['status'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['pass'] = $user['password'];

        header('Location: /profile/index');
    }

    public function validateUser($email, $password)
    {
        $user = User::getUser($email, $password);

        if ($user) {
            return $user;
        }

        return 'No Found';
    }
}