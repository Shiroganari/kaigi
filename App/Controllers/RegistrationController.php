<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\UsersModel;
use App\Models\UsersTopics;

class RegistrationController extends Controller
{
    public function index()
    {
        session_start();

        if (isset($_SESSION['active'])) {
            header('Location: /profile');
            exit;
        }

        View::render('Registration/index.php');
    }

    public function signup()
    {
        $username = $this->post_params['username'];
        $email = $this->post_params['email'];
        $password = $this->post_params['pass'];

        if ($this->validateEnteredData($username, $email, $password) == 'ERROR') {
            echo 'Пожалуйста, проверьте корректность введенных Вами данных.';
            exit;
        }

        if (UsersModel::checkUser($username, $email)) {
            echo 'Такой пользователь уже существует.';
            exit;
        }

        UsersModel::userRegistration($username, $email, $password);
        header('Location: /login');
    }

    public function completeUserRegistration()
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
            'locationCountry' => $locationCountry,
            'locationCity' => $locationCity
        ];

        UsersModel::completeUserRegistration($userData);

        // If a user has selected at least one topic, then add it to the database
        $topics = $this->post_params['topics'];
        if (isset($topics)) {
            UsersTopics::addUsersTopics($userID, $topics);
        }

        $_SESSION['status'] = 2;
        header('Location: /profile');
    }

    protected function validateEnteredData(string $username, string $email, string $password): string
    {
        if (!$username || !$email || !$password) {
            return 'ERROR';
        }

        return 'OK';
    }
}