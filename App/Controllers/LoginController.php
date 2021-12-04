<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\UsersModel;

class LoginController extends Controller
{
    public function index()
    {
        session_start();

        // If a user has already logged in, then redirect to the profile page
        if (isset($_SESSION['active'])) {
            header('Location: /profile');
            exit;
        }

        View::render('Login/index.php');
    }

    public function signin()
    {
        $email = $this->post_params['email'];
        $password = $this->post_params['pass'];
        $user = $this->userAuthentication($email, $password);

        if (gettype($user) !== 'array') {
            header('Location: /login');
            exit;
        }

        session_start();

        $_SESSION['active'] = true;
        $_SESSION['status'] = $user['status'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['pass'] = $user['password'];
        $_SESSION['userID'] = $user['id'];

        header('Location: /profile');
    }

    public function userAuthentication(string $email, string $password)
    {
        $user = UsersModel::getUser($email);

        if (!$user) {
            return 'Wrong email';
        }

        $hashPassword = $user['password'];

        if (password_verify($password, $hashPassword)) {
            return $user;
        }

        return 'Wrong password';
    }
}