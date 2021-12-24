<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Core\Controller;

class UsersController extends Controller
{
    public function showUsers()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Content-Type: application/json');

        $name = '';

        if (isset($_GET['name']) and $_GET['name'] !== 'undefined') {
            $name = $_GET['name'];
        }

        echo(json_encode(UsersModel::getUsersWhereFilters($name)));
    }

    public function changeUserStatus()
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: *');

        $param_string = file_get_contents('php://input');
        $array = json_decode($param_string, true);

        $userID = $array['userID'];
        $statusID = $array['userStatus'];

        UsersModel::changeUserStatus($userID, $statusID);
    }
}
