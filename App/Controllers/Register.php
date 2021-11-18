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
        $firstName = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $location = 'Novosibirsk';

        User::registerNewUser($firstName, $email, $password, $location);
    }
}