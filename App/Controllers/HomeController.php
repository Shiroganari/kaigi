<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public function index()
    {
        session_start();

        View::renderTemplate('home/index','Kaigi | Главная страница', 'home');
    }
}