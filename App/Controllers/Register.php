<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\User;
use App\Models\UsersTopics;

class Register extends Controller
{
    public function indexAction()
    {
        session_start();

        if (isset($_SESSION['active'])) {
            header('Location: /profile/index');
            exit;
        }

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
        header('Location: /login/index');
    }

    public function completeRegisterAction()
    {
        session_start();

        $userID = $_SESSION['userID'];

        $firstName = $this->post_params['first_name'];
        $lastName = $this->post_params['last_name'];
        $descr = $this->post_params['descr'];
        $locationCountry = $this->post_params['country'];
        $locationCity = $this->post_params['city'];
        $topics = $this->post_params['topics'];

        User::completeUserRegister($userID, $firstName, $lastName, $descr, $locationCountry, $locationCity);

        // If a user has selected at least one topic, then add it to the database
        if (isset($topics)) {
            UsersTopics::addUsersTopics($userID, $topics);
        }

        $_SESSION['status'] = 2;
        header('Location: /profile/index');
    }

    protected function validate(string $username, string $email, string $password)
    {
        if (!$username || !$email || !$password) {
           return 'ERROR';
        }

        return 'OK';
    }
}