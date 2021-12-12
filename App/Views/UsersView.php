<?php

namespace App\Views;

use Core\View;

class UsersView extends View
{
    public static function renderUser($userData)
    {
        ob_start();

        for ($i = 0; $i < count($userData); $i++) {
            View::render('component:member-item',
                [
                    'userData' => $userData[$i]
                ]
            );
        }

        return ob_get_clean();
    }
}