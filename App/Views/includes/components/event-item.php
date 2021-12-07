<?php
    $eventID = $eventData['eventID'];
    $eventTitle = $eventData['eventTitle'];
    $eventDescription = $eventData['eventDescription'];
    $eventCountry = $eventData['eventCountry'];
    $eventCity = $eventData['eventCity'];
    $eventDate = $eventData['eventDate'];
    $eventFormat = $eventData['eventFormat'];
    $eventCategory = $eventData['eventCategory'];
    $eventMembersCount = $eventData['eventMembersCount'];
 ?>

<a class="event-item" href="/event/<?php echo $eventID?>">

    <div class="event-item__avatar">
        <img class="event-item__img" src="/images/mongol.jpg" alt="Event Picture">
    </div>

    <div class="event-item__information">
        <h3 class="event-item__title">
            <?php echo $eventTitle?>
        </h3>

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
                    echo $eventCountry;
                    if ($eventCity != '') {
                        echo ', ' . $eventCity;
                    }
                } else {
                    echo 'Онлайн';
                }
            ?>
        </div>

        <div class="event-item__time">
            <?php
                echo $eventDate;
            ?>
        </div>

        <div class="event-item__members">
            Количество участников:
            <?php
                echo ' ' . $eventMembersCount;
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