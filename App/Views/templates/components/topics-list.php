<?php

foreach ($topics as $topic) {
    $topicName = $topic['topics_name'];

    echo '<a href="#" class="label-choice">';
    echo "<input class='label-choice__checkbox' name='topics[]' type='$inputType' value='$topicName'>";
    echo "<span class='label-choice__title'>$topicName</span>";
    echo '</a>';
}