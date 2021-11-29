<?php

namespace App\Controllers;

use App\Models\FormatsModel;
use App\Models\TopicsModel;
use App\Models\UsersModel;
use Core\Controller;
use Core\View;

use App\Models\CategoriesModel;
use App\Models\EventsModel;
use App\Models\EventsTopicsModel;

class Events extends Controller
{
    function indexAction()
    {
        View::render('Events/index.php');
    }

    function eventPageAction()
    {
        $eventID = $this->route_params['id'];
        $eventData = EventsModel::getEventInfo($eventID);
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

    function newAction()
    {
        $args['categories'] = CategoriesModel::getAll();

        View::render('Events/new.php', $args);
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

    function topicsAction()
    {
        $categoryName = $this->post_params['category'];

        $category = CategoriesModel::getCategoryId($categoryName);
        $categoryID = null;

        if ($category) {
            $categoryID = $category['id'];
        }

        if ($categoryID) {
            $topics = TopicsModel::getTopicByCategory($categoryID);

            foreach ($topics as $topic) {
                $topicName = $topic['name'];

                echo '<label class="label-choice">';
                    echo "<input class='label-choice__checkbox' name='event-topics[]' type='checkbox' value='$topicName'>";
                    echo "<span class='label-choice__title'>$topicName</span>";
                echo '</label>';
            }
        }
    }
}