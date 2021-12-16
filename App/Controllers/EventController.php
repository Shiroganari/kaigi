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

use App\Views\CategoriesView;
use App\Views\TopicsView;
use App\Views\UsersView;

class EventController extends Controller
{
    public function index()
    {
        session_start();

        $eventID = $this->route_params['id'];
        $eventData = EventsModel::getEventInfoById($eventID);
        $eventTitle = $eventData['title'];
        $eventTopics = EventsTopicsModel::getEventTopics($eventID);
        $eventMembersCount = EventsMembersModel::countEventMembers($eventID);
        $eventMembersID = EventsMembersModel::getAllMembers($eventID);
        $formatName = FormatsModel::getFormatName($eventData['formats_id']);
        $categoryName = CategoriesModel::getCategoryName($eventData['categories_id']);
        $organizerID = $eventData['users_id'];
        $organizer = UsersModel::getUserById($organizerID);

        $userID = null;
        $user = null;
        $isMember = false;
        $eventMembers = [];

        foreach ($eventMembersID as $value) {
            $eventMembers[] = UsersModel::getUserById($value['users_id']);
        }

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        }

        if ($userID) {
            $user = EventsMembersModel::getUser($eventID, $userID);
        }

        if ($user) {
            $isMember = true;
        }

        $membersList = null;

        if ($userID == $organizerID) {
            $organizerPrivileges = true;
            $membersList = UsersView::renderUser($eventMembers, $organizerPrivileges);
        } else {
            $organizerPrivileges = false;
            $membersList = UsersView::renderUser($eventMembers, $organizerPrivileges);
        }

        $topicsList = TopicsView::renderTopics($eventTopics, 'text');

        ob_start();
        View::render('component:report-button',
            [
                'reportType' => 'event',
                'nickname' => $eventData['title'],
                'userID' => $userID
            ]
        );
        $reportButton = ob_get_clean();

        View::renderTemplate('event/index', "Kaigi | $eventTitle", 'events',
        [
            'eventData' => $eventData,
            'eventFormat' => $formatName,
            'eventCategory' => $categoryName,
            'organizer' => $organizer,
            'topicsList' => $topicsList,
            'userID' => $userID,
            'isMember' => $isMember,
            'eventMembersCount' => $eventMembersCount['COUNT(*)'],
            'membersList' => $membersList,
            'reportButton' => $reportButton
        ]);
    }

    public function eventCreationPage()
    {
        session_start();

        if (!isset($_SESSION['userID'])) {
            header('Location: /');
            exit;
        }

        $categories = CategoriesModel::getAll();
        $categoriesList = CategoriesView::renderCategories($categories);
        View::renderTemplate('event/new-event', 'Kaigi | Новое событие', 'events',
            [
                'categoriesList' => $categoriesList
            ],
            [
                'http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css',
                '/cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css'
            ]
        );
    }

    public function createEvent()
    {
        session_start();

        $userID = $_SESSION['userID'];

        $categoryName = $this->post_params['entity-category'];
        $formatName = $this->post_params['entity-format'];

        $categoryInfo = CategoriesModel::getCategoryId($categoryName);
        $formatInfo = FormatsModel::getFormatId($formatName);

        $eventTitle = $this->post_params['entity-title'];
        $eventDescription = $this->post_params['entity-description'];
        $eventCategoryId = $categoryInfo['id'];
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
        $eventID = EventsModel::getLastRecord('events');
        $eventID = $eventID['MAX(id)'];

        if (isset($eventTopics)) {
            EventsTopicsModel::addEventsTopics($eventID, $eventTopics);
        }

        EventsMembersModel::newMember($eventID, $userID, ORGANIZER);

        header('Location: /event/' . $eventID);
    }

    public function eventParticipation()
    {
        $userID = (int)$this->post_params['userID'];
        $entityID = (int)$this->post_params['entityID'];

        if (EventsMembersModel::getUser($entityID, $userID)) {
            EventsMembersModel::removeMember($entityID, $userID);
            echo json_encode('Left');
            exit;
        }

        EventsMembersModel::newMember($entityID, $userID, MEMBER);
        echo json_encode('Join');
    }

    public function kickMember()
    {
        $userID = $this->post_params['userID'];
        $eventID = $this->post_params['entityID'];

        EventsMembersModel::removeMember($eventID, $userID);
        echo json_encode('The user has been kicked');
    }
}