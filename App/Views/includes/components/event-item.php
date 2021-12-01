<?php
    $eventID = $eventData['eventID'];
    $eventTitle = $eventData['eventTitle'];
    $eventDescription = $eventData['eventDescription'];
    $eventCountry = $eventData['eventCountry'];
    $eventCity = $eventData['eventCity'];
    $eventDate = $eventData['eventDate'];
    $eventTime = $eventData['eventTime'];
    $eventFormat = $eventData['eventFormat'];
    $eventCategory = $eventData['eventCategory'];
 ?>

<a class="event-item" href="/events/event-page/<?php echo $eventID?>">

    <div class="event-item__avatar">
        <img class="event-item__img" src="/images/mongol.jpg" alt="Event Picture">
    </div>

    <div class="event-item__information">
        <div class="event-item__title">
            <?php echo $eventTitle?>
        </div>

        <?php if ($eventDescription): ?>
            <div class="event-item__description">
                <?php echo $eventDescription?>
            </div>
        <?php else: ?>
            <div class="event-item__description">Описание отсутствует</div>
        <?php endif ?>

        <div class="event-item__location">
            <?php
            if ($eventCountry) {
                echo $eventCountry . ', ' . $eventCity;
            } else {
                echo 'Онлайн';
            }
            ?>
        </div>

        <div class="event-item__time">
            <?php
                echo $eventDate . ', ' . $eventTime;
            ?>
        </div>


        <div class="event-item__categories">
            <div class="event-item__subtitle">Категории:</div>
            <?php
                echo '<span>';
                    echo "$eventCategory";
                echo '</span>';
            ?>
        </div>
    </div>
</a>