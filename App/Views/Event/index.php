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
    <?php
        $eventID = $eventData['id'];

        $activeClass = '';

        if ($isMember) {
            $activeClass = 'join-event--active';
        }

        require_once(dirname(__DIR__) . LAYOUTS . 'header.php');
    ?>
    <!-- HEADER END -->

    <!-- EVENT -->
    <section class="event">
        <div class="container">
            <div class="event__inner">
                <div class="event-header">
                    <div class="event-header__avatar">
                        <img class="event-header__img" src="<?php ROOT?>/images/mongol.jpg" alt="Event Picture">
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

                        <div class="event-header__date">
                            Дата начала:
                            <?php echo date('Y-m-d', strtotime($eventData['date_start'])) ?>
                        </div>

                        <div class="event-header__time">
                            Время начала:
                            <?php echo date('H:i', strtotime($eventData['date_start'])) ?>
                        </div>

                        <div class="event-header__category">
                            Категория:
                            <?php echo $eventCategory['name'] ?>
                        </div>

                        <div class="event-header__member">
                            <input id="user-id" type="text" value="<?php echo $userID?>" hidden>
                            <input id="event-id" type="text" value="<?php echo $eventID?>" hidden>
                            <input id="is-member" type="text" value="<?php echo $isMember?>" hidden>
                            <button class="button join-event <?php echo $activeClass?>" id="join-event">
                                <?php
                                    if ($isMember) {
                                        echo 'Вы участвуете';
                                    } else {
                                        echo 'Стать участником';
                                    }
                                ?>
                            </button>
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
                            Core\View::render('includes/components/topics-list.php',
                                [
                                    'topics' => $eventTopics,
                                    'inputType' => 'text',
                                    'column' => 'topics_name'
                                ]
                            );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- EVENT END -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php ROOT ?>/scripts/eventPage.js"></script>
</body>
</html>