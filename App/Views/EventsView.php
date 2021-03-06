<?php

namespace App\Views;

use Core\View;

use App\Models\CategoriesModel;
use App\Models\EventsMembersModel;

class EventsView extends View
{
    public static function renderEvent($event, $eventInfo)
    {
        ob_start();

        $eventData = [
            'id' => $event['id'],
            'title' => $event['title'],
            'description' => $event['description'],
            'country' => $event['location_country'],
            'city' => $event['location_city'],
            'dateStart' => $event['date_start'],
            'categoryTitle' => $eventInfo['category_title'],
            'membersCount' => $eventInfo['members_count']
        ];

        View::render('component:event-item', ['eventData' => $eventData]);

        return ob_get_clean();
    }
}