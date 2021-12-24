<?php

    $id = $eventData['id'];
    $title = $eventData['title'];
    $description = $eventData['description'];
    $country = $eventData['country'];
    $city = $eventData['city'];
    $dateStart = $eventData['dateStart'];
    $categoryTitle = $eventData['categoryTitle'];
    $membersCount = $eventData['membersCount'];

?>

<a class="event-item" href="/event/<?php echo $id; ?>">

    <div class="event-item__avatar">
        <img class="event-item__img" src="/images/mongol.jpg" alt="Event Picture">
    </div>

    <div class="event-item__information">
        <h3 class="event-item__title"><?php echo $title; ?></h3>

        <?php if ($description): ?>
            <div class="event-item__description">
                <?php echo $description; ?>
            </div>
        <?php else: ?>
            <div class="event-item__description">Описание отсутствует</div>
        <?php endif ?>

        <div class="event-item__location">
            <?php
                if ($country) {
                    echo $country;

                    if ($city != '') {
                        echo ', ' . $country;
                    }
                } else {
                    echo 'Онлайн';
                }
            ?>
        </div>

        <div class="event-item__time">
            <?php echo $dateStart; ?>
        </div>

        <div class="event-item__members">
            Количество участников:
            <?php echo ' ' . $membersCount; ?>
        </div>

        <div class="event-item__categories">
            <div class="event-item__subtitle">Категории:</div>
            <?php
                echo '<span>';
                    echo "$categoryTitle";
                echo '</span>';
            ?>
        </div>
    </div>
</a>