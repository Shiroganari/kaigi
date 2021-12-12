<?php

$firstName = $userData['first_name'];
$lastName = $userData['last_name'];
$username = $userData['username'];
$locationCountry = $userData['location_country'];
$locationCity = $userData['location_city'];

?>

<a class="member-item" href="#">
    <div class="member-item__avatar">
        <img class="member-item__img" src="/images/mongol.jpg" alt="member Picture">
    </div>

    <div class="member-item__information">
        <div class="member-item__name">
         <?php echo $firstName . ' ' . $lastName; ?>
        </div>

        <div class="member-item__username">
            <?php echo $username; ?>
        </div>

        <div class="member-item__location">
            <?php
                echo $locationCountry;

                if ($locationCity != '') {
                    echo ', ' . $locationCity;
                }
            ?>
        </div>
    </div>
</a>
