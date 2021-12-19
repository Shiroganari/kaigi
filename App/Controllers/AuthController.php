<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;

use App\Models\UsersModel;
use App\Models\UsersTopics;
use App\Models\TopicsModel;

use App\Views\TopicsView;

class AuthController extends Controller
{
    public function registrationPage()
    {
        session_start();

        if (isset($_SESSION['active'])) {
            header('Location: /user/' . $_SESSION['userID']);
            exit;
        }

        View::renderTemplate('auth/registration', 'Kaigi | Регистрация', 'auth');
    }

    public function registration()
    {
        $username = $this->post_params['username'];
        $email = $this->post_params['email'];
        $password = $this->post_params['pass'];

        if ($this->validateRegistrationData($username, $email, $password) == 'ERROR') {
            echo 'Пожалуйста, проверьте корректность введенных Вами данных.';
            exit;
        }

        if (UsersModel::isUserExists($username, $email)) {
            echo 'Такой пользователь уже существует.';
            exit;
        }

        UsersModel::userRegistration($username, $email, $password);

        header('Location: /login');
    }

    public function loginPage()
    {
        session_start();

        // If a user has already logged in, then redirect to the profile page
        if (isset($_SESSION['active'])) {
            header('Location: /user/' . $_SESSION['userID']);
            exit;
        }

        View::renderTemplate('auth/login', 'Kaigi | Вход в аккаунт', 'auth');
    }

    public function login()
    {
        session_start();

        $email = $this->post_params['email'];
        $password = $this->post_params['pass'];
        $user = $this->userAuthentication($email, $password);

        if (gettype($user) !== 'object') {
            header('Location: /login');
            exit;
        }

        $_SESSION['active'] = true;
        $_SESSION['status'] = $user->getStatus();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['userID'] = $user->getID();

        if ($user->getStatus() == TRIAL_STATUS) {
            header('Location: /complete-registration');
            exit;
        }

        header('Location: /home');
    }

    public function completeRegistrationPage()
    {
        session_start();

        if (!isset($_SESSION['status'])) {
            header('Location: /');
            exit;
        }

        if (!$_SESSION['status'] == 1) {
            header('Location: /user/' . $_SESSION['userID']);
            exit;
        }

        $topics = TopicsModel::getList('title');
        $topicsList = TopicsView::renderTopics($topics, 'checkbox');

        View::renderTemplate('auth/completeRegistration', 'Kaigi | Завершение регистрации', 'auth',
            [
                'topicsList' => $topicsList
            ]
        );
    }

    public function completeRegistration()
    {
        session_start();

        $userID = $_SESSION['userID'];
        $firstName = $this->post_params['first_name'];
        $lastName = $this->post_params['last_name'];
        $description = $this->post_params['description'];
        $locationCountry = $this->post_params['country'];
        $locationCity = $this->post_params['city'];

        $userData = [
            'userID' => $userID,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'description' => $description,
            'country' => $locationCountry,
            'city' => $locationCity
        ];

        UsersModel::completeUserRegistration($userData);

        // If a user has selected at least one topic, then add it to the database
        $topics = $this->post_params['topics'];

        if (isset($topics)) {
            UsersTopics::addTopics($userID, $topics);
        }

        $_SESSION['status'] = 2;
        header('Location: /home');
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /');
    }

    protected function validateRegistrationData(string $username, string $email, string $password): string
    {
        if (!$username || !$email || !$password) {
            return 'ERROR';
        }

        return 'OK';
    }

    protected function userAuthentication(string $email, string $password)
    {
        $user = new UsersModel();
        $user = $user->getUserBy('email', $email);

        if (!$user) {
            return 'Wrong email';
        }

        $hashPassword = $user->getPassword();

        if (password_verify($password, $hashPassword)) {
            return $user;
        }

        return 'Wrong password';
    }
}