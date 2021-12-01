<?php
    foreach($categories as $category) {
        $categoryName = $category['name'];
        echo "<option value='$categoryName'>$categoryName</option>";
    }