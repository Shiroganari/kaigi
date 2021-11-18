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
}