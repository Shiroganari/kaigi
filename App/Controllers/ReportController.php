<?php

namespace App\Controllers;

use App\Models\EventsModel;
use App\Models\EventsReports;
use App\Models\GroupsModel;
use App\Models\GroupsReports;
use App\Models\UsersModel;
use App\Models\UsersReports;
use Core\Controller;

class ReportController extends Controller
{
    public function sendReport()
    {
        $senderID = $this->post_params['senderID'];
        $nickname = $this->post_params['nickname'];
        $description = $this->post_params['description'];
        $reportType = $this->post_params['report-type'];
        $url = $this->post_params['url'];

        if ($reportType === 'user') {
            $user = new UsersModel();
            $user = $user->getUserBy('username', $nickname);
            UsersReports::createReport($senderID, $user->getID(), $description);
        } elseif ($reportType === 'group') {
            $group = new GroupsModel();
            $group = $group->getGroupBy('title', $nickname);
            GroupsReports::createReport($senderID, $group->getID(), $description);
        } elseif ($reportType === 'event') {
            $event = new EventsModel();
            $event = $event->getEventBy('title', $nickname);
            EventsReports::createReport($senderID, $event->getID(), $description);
        }

        header('Location: ' . $url);
    }
}