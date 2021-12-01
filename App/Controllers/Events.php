<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\FormatsModel;
use App\Models\UsersModel;
use App\Models\CategoriesModel;
use App\Models\EventsModel;
use App\Models\EventsTopicsModel;

class Events extends Controller
{
    function indexAction()
    {
        $categories = CategoriesModel::getAll();

        View::render('Events/index.php', ['categories' => $categories]);
    }

    function eventPageAction()
    {
        $eventID = $this->route_params['id'];
        $eventData = EventsModel::getEventInfoById($eventID);
        $formatName = FormatsModel::getFormatName($eventData['formats_id']);
        $categoryName = CategoriesModel::getCategoryName($eventData['categories_id']);
        $organizerName = UsersModel::getUserById($eventData['users_id']);
        $eventTopics = EventsTopicsModel::getEventTopics($eventID);

        View::render('Events/event.php',
            [
                'eventData' => $eventData,
                'eventFormat' => $formatName,
                'eventCategory' => $categoryName,
                'organizerName' => $organizerName,
                'eventTopics' => $eventTopics
            ]);
    }

    function newEventAction()
    {
        session_start();

        $categories = CategoriesModel::getAll();

        if (!isset($_SESSION['userID'])) {
            header('Location: /home/index');
            exit;
        }

        View::render('Events/new-event.php', ['categories' => $categories]);
    }

    function createAction()
    {
        session_start();

        $categoryName = $this->post_params['event-category'];
        $formatName = $this->post_params['event-format'];

        $categoryInfo = CategoriesModel::getCategoryId($categoryName);
        $formatInfo = FormatsModel::getFormatId($formatName);

        $eventID = rand(1, 1000);
        $eventTitle = $this->post_params['event-title'];
        $eventCategoryId = $categoryInfo['id'];
        $eventDescription = $this->post_params['event-description'];
        $eventDate = $this->post_params['event-date'];
        $eventTime = $this->post_params['event-time'];
        $eventFormat = $formatInfo['id'];
        $eventCountry = $this->post_params['event-country'];
        $eventCity = $this->post_params['event-city'];
        $eventStreet = $this->post_params['event-street'];
        $eventTopics = $this->post_params['event-topics'];
        $eventOrganizer = $_SESSION['userID'];

        // If the event format is 'offline'
        if ($eventFormat == 1) {
            $eventCountry = '';
            $eventCity = '';
            $eventStreet = '';
        }

        $eventData = [
            'eventID' => $eventID,
            'eventTitle' => $eventTitle,
            'eventCategory' => $eventCategoryId,
            'eventDescription' => $eventDescription,
            'eventDate' => $eventDate,
            'eventTime' => $eventTime,
            'eventFormat' => $eventFormat,
            'eventCountry' => $eventCountry,
            'eventCity' => $eventCity,
            'eventStreet' => $eventStreet,
            'eventOrganizer' => $eventOrganizer
        ];

        EventsModel::newEvent($eventData);
        EventsTopicsModel::addEventsTopics($eventID, $eventTopics);

        header('Location: /events/event-page/' . $eventID);
    }

    // Ajax Request
    function showEventsAction()
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

            $eventData = [
                'eventID' => $event['id'],
                'eventTitle' => $event['title'],
                'eventDescription' => $event['description'],
                'eventCountry' => $event['location_country'],
                'eventCity' => $event['location_city'],
                'eventFormat' => $eventFormatID,
                'eventCategory' => $categoryInfo['name'],
                'eventDate' => $event['date_start'],
                'eventTime' => $event['time_start']
            ];

            View::render('includes/components/event-item.php', ['eventData' => $eventData]);
        }
    }
}