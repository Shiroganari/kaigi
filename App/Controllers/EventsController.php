<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\CategoriesModel;
use App\Models\FormatsModel;
use App\Models\EventsModel;
use App\Models\EventsMembersModel;

class EventsController extends Controller
{
    public function index()
    {
        $categories = CategoriesModel::getAll();

        View::render('Events/index.php', ['categories' => $categories]);
    }

    // [Ajax Request]
    public function showEvents()
    {
        $eventFormatID = null;
        $eventCategoryID = null;

        $formatName = $this->post_params['eventFormat'];
        $eventFormat = FormatsModel::getFormatId($formatName);

        $categoryName = $this->post_params['eventCategory'];
        $eventCategory = CategoriesModel::getCategoryId($categoryName);

        if ($eventFormat) {
            $eventFormatID = $eventFormat['id'];
        }

        if ($eventCategory) {
            $eventCategoryID = $eventCategory['id'];
        }

        $eventTitle = $this->post_params['eventTitle'];
        $eventCountry = $this->post_params['eventCountry'];
        $eventCity = $this->post_params['eventCity'];

        $events = EventsModel::getEventsByFilters($eventTitle, $eventCountry, $eventCity, $eventFormatID, $eventCategoryID);

        foreach ($events as $event) {
            $categoryInfo = CategoriesModel::getCategoryName($event['categories_id']);
            $eventMembers = EventsMembersModel::countEventMembers($event['id']);

            $eventData = [
                'eventID' => $event['id'],
                'eventTitle' => $event['title'],
                'eventDescription' => $event['description'],
                'eventCountry' => $event['location_country'],
                'eventCity' => $event['location_city'],
                'eventFormat' => $eventFormatID,
                'eventCategory' => $categoryInfo['name'],
                'eventDate' => $event['date_start'],
                'eventMembersCount' => $eventMembers['COUNT(*)']
            ];

            View::render('includes/components/event-item.php', ['eventData' => $eventData]);
        }
    }
}