<?php

namespace App\Views;

use Core\View;

use App\Models\CategoriesModel;
use App\Models\EventsMembersModel;

class EventsView extends View
{
    public static function renderEvents($events)
    {
        ob_start();

        foreach ($events as $event) {
            $categoryInfo = CategoriesModel::getCategoryBy('id', $event['categories_id']);
            $eventMembersCount = EventsMembersModel::countMembers($event['id']);

            $eventData = [
                'id' => $event['id'],
                'title' => $event['title'],
                'description' => $event['description'],
                'country' => $event['location_country'],
                'city' => $event['location_city'],
                'dateStart' => $event['date_start'],
                'membersCount' => $eventMembersCount,
                'category' => $categoryInfo['title']
            ];

            View::render('component:event-item', ['eventData' => $eventData]);
        }

        return ob_get_clean();
    }
}