<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\User;

class Login extends Controller
{
    public function indexAction()
    {
        View::render('Login/index.php');
    }

    public function signinAction()
    {
        $email = $this->post_params['email'];
        $password = $this->post_params['pass'];

        if ($this->validateUser($email, $password) == 'OK') {
            echo 'Авторизация прошла успешно!';
        } else {
            echo 'Неверный логин или пароль';
        }
    }

    public function validateUser($email, $password)
    {
        if (User::getUser($email, $password)) {
            return 'OK';
        }
    }

}