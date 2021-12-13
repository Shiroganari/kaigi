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
    public function createReport()
    {
        $senderID = $this->post_params['senderID'];
        $nickname = $this->post_params['nickname'];
        $description = $this->post_params['description'];
        $reportType = $this->post_params['report-type'];
        $url = $this->post_params['url'];

        if ($reportType === 'user') {
            $user = UsersModel::getUserByUsername($nickname);
            UsersReports::createReport($senderID, $user['id'], $description);
        } elseif ($reportType === 'group') {
            $group = GroupsModel::getGroupInfoByTitle($nickname);
            GroupsReports::createReport($senderID, $group['id'], $description);
        } elseif ($reportType === 'event') {
            $event = EventsModel::getEventInfoByTitle($nickname);
            EventsReports::createReport($senderID, $event['id'], $description);
        }

        header('Location: ' . $url);
    }
}