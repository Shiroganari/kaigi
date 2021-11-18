<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Register extends Controller
{
    public function indexAction()
    {
        View::render('Register/index.php');
    }
}