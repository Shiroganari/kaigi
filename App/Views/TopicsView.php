<?php

namespace App\Views;

use Core\View;

class TopicsView extends View
{
    public static function renderTopics($topics, $inputType)
    {
        ob_start();

        View::render('component:topics-list',
            [
                'topics' => $topics,
                'inputType' => $inputType
            ]
        );

        return ob_get_clean();
    }
}