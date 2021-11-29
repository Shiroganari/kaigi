<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Страница события</title>
    <link rel="stylesheet" href="/styles/pages/events/events.css">
</head>
<body>
    <!-- HEADER -->
    <?php require_once(dirname(__DIR__) . LAYOUTS . 'header.php'); ?>
    <!-- HEADER END -->

    <!-- EVENT -->
    <section class="event">
        <div class="container">
            <div class="event__inner">
                <div class="event-header">
                    <div class="event-header__avatar">
                        <img class="event-header__img" src="<?php ROOT?>/images/mongol.jpg"" alt="Event Picture">
                    </div>

                    <div class="event-header__information">
                        <h1 class="event-header__title">
                            <?php echo $eventData['title']?>
                        </h1>

                        <div class="event-header__organizer">
                            Организатор:
                            <?php echo ($organizerName['first_name'] . ' ' . $organizerName['last_name'] . ' [' .
                                $organizerName['username'] . ']'); ?>
                        </div>

                        <div class="event-header__format">
                            Формат:
                            <?php echo $eventFormat['name'] ?>
                        </div>

                        <?php if ($eventData['location_country']):?>
                            <div class="event-header__location">
                                Локация:
                                <div class="event-header__country">
                                    <?php echo $eventData['location_country'] . ', '?>
                                </div>
                                <div class="event-header__city">
                                    <?php echo $eventData['location_city'] . ', '?>
                                </div>
                                <div class="event-header__street">
                                    <?php echo $eventData['location_street']?>
                                </div>
                            </div>
                        <?php endif;?>

                        <div class="event-header__category">
                            Категория:
                            <?php echo $eventCategory['name']; ?>
                        </div>
                    </div>
                </div>

                <div class="event-content">
                    <div class="event-content__header">
                        <div class="event-content__title active">Описание</div>
                        <div class="event-content__title">Участники</div>
                        <div class="event-content__title">Комментарии</div>
                    </div>

                    <div class="event-content__description">
                        <?php echo $eventData['description']?>
                    </div>

                </div>

                <div class="event-topics">
                    <div class="event-topics__title">Топики:</div>

                    <div class="event-topics__inner">
                        <?php
                            for ($i = 0; $i < count($eventTopics); $i++) {
                                $topicName = $eventTopics[$i]['topics_name'];

                                echo '<div class="label-choice">';
                                    echo "<input class='label-choice__checkbox' name='topics[]' type='text' value='$topicName'>";
                                    echo "<span class='label-choice__title'>$topicName</span>";
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- EVENT END -->

</body>
</html>