<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Core\Controller;
use Core\View;

use App\Models\CategoriesModel;
use App\Models\FormatsModel;
use App\Models\EventsModel;

use App\Views\CategoriesView;
use App\Views\EventsView;

class EventsController extends Controller
{
    public function index()
    {
        session_start();

        $categories = CategoriesModel::getList('title');
        $categoriesList = CategoriesView::renderCategories($categories);

        View::renderTemplate('events/index', 'Kaigi | Все события', 'events',
            [
                'categoriesList' => $categoriesList
            ]
        );
    }

    public function myEventsPage()
    {
        session_start();

        if (!isset($_SESSION['userID'])) {
            header('Location: /login');
        }

        View::renderTemplate('events/my-events', 'Kaigi | Мои события', 'events');
    }

    // [Ajax Request]
    public function showEvents()
    {
        session_start();

        $userID = null;

        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        }

        $eventFormatID = null;
        $eventCategoryID = null;
        $eventFormat = null;
        $eventCategory = null;
        $eventTitle = null;
        $eventCountry = null;
        $eventCity = null;
        $myEvents = null;
        $isOrganizer = false;

        if (isset($this->post_params['eventFormat'])) {
            $formatName = $this->post_params['eventFormat'];
            $eventFormat = FormatsModel::getFormatBy('title', $formatName);
        }

        if (isset($this->post_params['eventCategory'])) {
            $categoryName = $this->post_params['eventCategory'];
            $eventCategory = CategoriesModel::getCategoryBy('title', $categoryName);
        }

        if ($eventFormat) {
            $eventFormatID = $eventFormat['id'];
        }

        if ($eventCategory) {
            $eventCategoryID = $eventCategory['id'];
        }

        if (isset($this->post_params['eventTitle'])) {
            $eventTitle = $this->post_params['eventTitle'];
        }

        if (isset($this->post_params['eventCountry'])) {
            $eventCountry = $this->post_params['eventCountry'];
        }

        if (isset($this->post_params['eventCity'])) {
            $eventCity = $this->post_params['eventCity'];
        }

        if (isset($this->post_params['myEvents'])) {
            $myEvents = true;
        }

        if (isset($this->post_params['isOrganizer'])) {
            $isOrganizer = $this->post_params['isOrganizer'];
        }

        $events = null;

        if ($myEvents) {
            $events = EventsModel::getUserEvents($userID, $isOrganizer, $eventTitle);
        } else {
            $events = EventsModel::getEventsByFilters(
                $eventTitle,
                $eventCountry,
                $eventCity,
                $eventFormatID,
                $eventCategoryID
            );
        }

        echo EventsView::renderEvents($events);
    }
}