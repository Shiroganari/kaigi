<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\TopicsModel;

use Core\Controller;

class Topics extends Controller
{
    // Ajax Request
    function getAllTopicsAction()
    {
        $categoryName = $this->post_params['category'];

        $category = CategoriesModel::getCategoryId($categoryName);
        $categoryID = null;

        if ($category) {
            $categoryID = $category['id'];
        }

        if ($categoryID) {
            $topics = TopicsModel::getTopicByCategory($categoryID);
            echo json_encode($topics);
        }
    }
}