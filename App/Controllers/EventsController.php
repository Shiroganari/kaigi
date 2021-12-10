<?php

namespace App\Controllers;

use App\Views\CategoriesView;
use App\Views\EventsView;
use Core\Controller;
use Core\View;

use App\Models\CategoriesModel;
use App\Models\FormatsModel;
use App\Models\EventsModel;

class EventsController extends Controller
{
    public function index()
    {
        session_start();

        $categories = CategoriesModel::getAll();
        $categoriesList = CategoriesView::renderCategories($categories);

        View::renderTemplate('events/index', 'Kaigi | Все события', 'events',
            [
                'categoriesList' => $categoriesList
            ]
        );
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

        $events = EventsModel::getEventsByFilters(
            $eventTitle,
            $eventCountry,
            $eventCity,
            $eventFormatID,
            $eventCategoryID
        );

        echo EventsView::renderEvents($events);
    }
}