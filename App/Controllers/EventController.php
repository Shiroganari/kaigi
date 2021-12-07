<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\EventsMembersModel;
use App\Models\EventsTopicsModel;
use App\Models\EventsModel;
use App\Models\CategoriesModel;
use App\Models\FormatsModel;
use App\Models\UsersModel;

class EventController extends Controller
{
    public function index()
    {
        session_start();

        $eventID = $this->route_params['id'];
        $eventData = EventsModel::getEventInfoById($eventID);
        $formatName = FormatsModel::getFormatName($eventData['formats_id']);
        $categoryName = CategoriesModel::getCategoryName($eventData['categories_id']);
        $organizerName = UsersModel::getUserById($eventData['users_id']);
        $eventTopics = EventsTopicsModel::getEventTopics($eventID);
        $userID = 0;
        $user = null;
        $isMember = false;

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        }

        if ($userID) {
            $user = EventsMembersModel::getUser($eventID, $userID);
        }

        if ($user) {
            $isMember = true;
        }

        View::render('Event/index.php', [
            'eventData' => $eventData,
            'eventFormat' => $formatName,
            'eventCategory' => $categoryName,
            'organizerName' => $organizerName,
            'eventTopics' => $eventTopics,
            'userID' => $userID,
            'isMember' => $isMember
        ]);
    }

    public function eventCreationPage()
    {
        session_start();

        $categories = CategoriesModel::getAll();

        if (!isset($_SESSION['userID'])) {
            header('Location: /');
            exit;
        }

        View::render('Event/new-index.php', ['categories' => $categories]);
    }

    public function createEvent()
    {
        session_start();

        $userID = $_SESSION['userID'];

        $categoryName = $this->post_params['entity-category'];
        $formatName = $this->post_params['entity-format'];

        $categoryInfo = CategoriesModel::getCategoryId($categoryName);
        $formatInfo = FormatsModel::getFormatId($formatName);

        $eventID = rand(1, 1000);
        $eventTitle = $this->post_params['entity-title'];
        $eventCategoryId = $categoryInfo['id'];
        $eventDescription = $this->post_params['entity-description'];
        $eventDate = date('Y-m-d', strtotime($this->post_params['entity-date']));
        $eventTime = date('H:i', strtotime($this->post_params['entity-time']));
        $eventFormat = $formatInfo['id'];
        $eventCountry = $this->post_params['entity-country'];
        $eventCity = $this->post_params['entity-city'];
        $eventStreet = $this->post_params['entity-street'];
        $eventTopics = $this->post_params['entity-topics'];
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
            'eventDate' => $eventDate . ' ' . $eventTime,
            'eventFormat' => $eventFormat,
            'eventCountry' => $eventCountry,
            'eventCity' => $eventCity,
            'eventStreet' => $eventStreet,
            'eventOrganizer' => $eventOrganizer
        ];

        EventsModel::newEvent($eventData);

        if (isset($eventTopics)) {
            EventsTopicsModel::addEventsTopics($eventID, $eventTopics);
        }

        EventsMembersModel::newMember($eventID, $userID, 1);

        header('Location: /event/' . $eventID);
    }

    public function eventParticipation()
    {
        $userID = (int)$this->post_params['userID'];
        $entityID = (int)$this->post_params['entityID'];
        $roleID = 2; // Участник

        if (EventsMembersModel::getUser($entityID, $userID)) {
            EventsMembersModel::removeMember($entityID, $userID);
            echo json_encode('Left');
            exit;
        }

        EventsMembersModel::newMember($entityID, $userID, $roleID);
        echo json_encode('Join');
    }
}