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

        // Getting event data
        $event = new EventsModel();
        $event = $event->getEventBy('id', $eventID);
        $eventData = $event->createData();
        $category = CategoriesModel::getBy('id', $event->getCategoryID());
        $format = FormatsModel::getBy('id', $event->getFormatID());

        // Getting a list of event topics
        $eventTopics = EventsTopicsModel::getTopics($eventID);
        $topicsList = null;

        if ($eventTopics) {
            $topicsList = TopicsView::renderTopics($eventTopics, 'text');
        }

        // Getting data about event's organizer
        $organizer = new UsersModel();
        $organizer = $organizer->getUserBy('id', $event->getOrganizerID());
        $organizerData = $organizer->createData();

        $userID = null;
        $isMember = false;

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            $isMember = EventsMembersModel::isMember($eventID, $userID);
        }

        // Getting a list of event members
        $organizerPrivileges = $userID == $event->getOrganizerID();
        $eventMembers = EventsMembersModel::getEventMembers($eventID);
        $membersList = UsersView::renderUser($eventMembers, $organizerPrivileges);

        ob_start();
        View::render('component:report-button',
            [
                'reportType' => 'event',
                'nickname' => $event->getTitle(),
                'userID' => $userID
            ]
        );
        $reportButton = ob_get_clean();

        $eventTitle = $eventData['title'];
        View::renderTemplate('event/index', "Kaigi | $eventTitle", 'events',
        [
            'event' => $eventData,
            'organizer' => $organizerData,
            'topics' => $topicsList,
            'members' => $membersList,
            'category' => $category['title'],
            'format' => $format['title'],
            'userID' => $userID,
            'isMember' => $isMember,
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

        $categories = CategoriesModel::getList('title');
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

        $categoryInfo = CategoriesModel::getBy('title', $categoryName);
        $formatInfo = FormatsModel::getBy('title', $formatName);

        $eventTitle = $this->post_params['entity-title'];
        $eventDescription = $this->post_params['entity-description'];
        $eventCategoryID = $categoryInfo['id'];
        $eventDate = date('Y-m-d', strtotime($this->post_params['entity-date']));
        $eventTime = date('H:i', strtotime($this->post_params['entity-time']));
        $eventFormat = $formatInfo['id'];
        $eventCountry = $this->post_params['entity-country'];
        $eventCity = $this->post_params['entity-city'];
        $eventStreet = $this->post_params['entity-street'];
        $eventTopics = $this->post_params['entity-topics'];
        $eventOrganizerID = $_SESSION['userID'];

        // If the event format is 'offline'
        if ($eventFormat == 1) {
            $eventCountry = '';
            $eventCity = '';
            $eventStreet = '';
        }

        $eventData = [
            'title' => $eventTitle,
            'description' => $eventDescription,
            'country' => $eventCountry,
            'city' => $eventCity,
            'street' => $eventStreet,
            'format' => $eventFormat,
            'categoryID' => $eventCategoryID,
            'organizerID' => $eventOrganizerID,
            'dateStart' => $eventDate . ' ' . $eventTime
        ];

        EventsModel::newEvent($eventData);
        $eventID = EventsModel::getLast();

        if (isset($eventTopics)) {
            EventsTopicsModel::addTopics($eventID, $eventTopics);
        }

        EventsMembersModel::newMember($eventID, $userID, ORGANIZER);

        header('Location: /event/' . $eventID);
    }

    public function eventParticipation()
    {
        $userID = (int)$this->post_params['userID'];
        $entityID = (int)$this->post_params['entityID'];

        if (EventsMembersModel::isMember($entityID, $userID)) {
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