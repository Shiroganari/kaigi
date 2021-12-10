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
            $categoryInfo = CategoriesModel::getCategoryName($event['categories_id']);
            $eventMembers = EventsMembersModel::countEventMembers($event['id']);

            $eventData = [
                'eventID' => $event['id'],
                'eventTitle' => $event['title'],
                'eventDescription' => $event['description'],
                'eventCountry' => $event['location_country'],
                'eventCity' => $event['location_city'],
                'eventDate' => $event['date_start'],
                'eventMembersCount' => $eventMembers['COUNT(*)'],
                'eventCategory' => $categoryInfo['name']
            ];

            View::render('component:event-item', ['eventData' => $eventData]);
        }

        return ob_get_clean();
    }
}