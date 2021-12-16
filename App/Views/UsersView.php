<?php

namespace App\Views;

use Core\View;

class UsersView extends View
{
    public static function renderUser($userData, $organizerPrivileges)
    {
        ob_start();

        for ($i = 0; $i < count($userData); $i++) {
            View::render('component:member-item',
                [
                    'userData' => $userData[$i],
                    'organizerPrivileges' => $organizerPrivileges
                ]
            );
        }

        return ob_get_clean();
    }
}