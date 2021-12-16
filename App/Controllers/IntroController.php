<?php

namespace App\Controllers;

use Core\View;

class IntroController
{
    public function index()
    {
        session_start();

        if (isset($_SESSION['userID'])) {
            header('Location: /home');
            exit;
        }

        View::renderTemplate('intro/index','Kaigi | Главная страница', 'intro');
    }
}