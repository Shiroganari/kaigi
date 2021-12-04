<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public function index()
    {
        View::render('Home/index.php');
    }
}