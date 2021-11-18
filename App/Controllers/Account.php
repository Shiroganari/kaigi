<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Account extends Controller
{
    public function signupAction()
    {
        View::render('Account/signup.php');
    }
}