<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\User;

class Register extends Controller
{
    public function indexAction()
    {
        View::render('Register/index.php');
    }

    public function signupAction()
    {
        $username = $this->post_params['username'];
        $email = $this->post_params['email'];
        $password = $this->post_params['pass'];

        if ($this->validate($username, $email, $password) == 'ERROR') {
            echo 'Пожалуйста, проверьте корректность введенных Вами данных.';
            exit;
        }

        if (User::checkUser($username, $email)) {
            echo 'Такой пользователь уже существует.';
            exit;
        }

        User::registerNewUser($username, $email, $password);
    }

    protected function validate($username, $email, $password)
    {
        if (!$username || !$email || !$password) {
           return 'ERROR';
        }

        return 'OK';
    }
}