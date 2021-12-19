<?php

foreach ($topics as $topic) {
    echo '<a href="#" class="label-choice">';
        echo "<input class='label-choice__checkbox' name='topics[]' type='$inputType' value='$topic'>";
        echo "<span class='label-choice__title'>$topic</span>";
    echo '</a>';
}