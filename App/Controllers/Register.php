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
        $location = 'Novosibirsk';

        if ($this->validate($username, $email, $password) == 'OK') {
            User::registerNewUser($username, $email, $password, $location);
            echo 'Регистрация прошла успешно!';
        }
    }

    protected function validate($username, $email, $password)
    {
        if (!$username || !$email || !$password) {
           echo 'Ошибка. Введенные данные пользователя не прошли валидацию';
           exit;
        }

        return 'OK';
    }
}