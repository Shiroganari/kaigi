<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\TopicsModel;

use Core\Controller;

class TopicsController extends Controller
{
    // Ajax Request
    public function getAllTopics()
    {
        $categoryName = $this->post_params['category'];

        $category = CategoriesModel::getCategoryBy('title', $categoryName);
        $categoryID = null;

        if ($category) {
            $categoryID = $category['id'];
        }

        if ($categoryID) {
            $topics = TopicsModel::getTopicsByCategory($categoryID);
            echo json_encode($topics);
        }
    }
}