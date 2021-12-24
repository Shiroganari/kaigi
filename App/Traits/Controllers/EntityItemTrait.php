<?php

namespace App\Traits\Controllers;

use App\Models\EventsModel;
use App\Models\GroupsModel;

use App\Views\EventsView;
use App\Views\GroupsView;

trait EntityItemTrait
{
    public static function getEventsItems($events): string
    {
        $eventsList = null;

        foreach ($events as $event) {
            $eventInfo = EventsModel::getEventInfo($event);
            $eventsList .= EventsView::renderEvent($event, $eventInfo);
        }

        return $eventsList;
    }

    public static function getGroupsItems($groups): string
    {
        $groupsList = null;

        foreach ($groups as $group) {
            $groupInfo = GroupsModel::getGroupInfo($group);
            $groupsList .= GroupsView::renderGroup($group, $groupInfo);
        }

        return $groupsList;
    }
}