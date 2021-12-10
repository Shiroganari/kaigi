<?php

namespace App\Views;

use Core\View;

class CategoriesView extends View
{
    public static function renderCategories($categories)
    {
        ob_start();
        self::render('component:categories-list', ['categories' => $categories]);
        return ob_get_clean();
    }
}