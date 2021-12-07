<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Страница группы</title>
    <link rel="stylesheet" href="/styles/pages/groups/groups.css">
</head>
<body>
    <!-- HEADER -->
    <?php
        $groupID = $groupData['id'];

        $activeClass = '';

        if ($isMember) {
            $activeClass = 'entity-participation--active';
        }

    require_once(dirname(__DIR__) . LAYOUTS . 'header.php');
    ?>
    <!-- HEADER END -->

    <!-- GROUP -->
    <section class="group">
        <div class="group-header" style="background-image: url('/images/background.jpg');">
            <div class="group-header__logo">
                <img class="group-header__img" src="/images/mongol.jpg" alt="Logotype">
            </div>


            <input id="user-id" type="text" value="<?php echo $userID?>" hidden>
            <input id="entity-id" type="text" value="<?php echo $groupID?>" hidden>
            <input id="is-member" type="text" value="<?php echo $isMember?>" hidden>
            <button class="button entity-participation entity-participation--group <?php echo $activeClass?>" id="entity-participation">
                <?php
                    if ($isMember) {
                        echo 'Вы участник';
                    } else {
                        echo 'Вступить в группу';
                    }
                ?>
            </button>
        </div>

        <div class="container">
            <h1 class="group__title">
                <?php
                    echo $groupData['title'];
                ?>
            </h1>
            <div class="group__content">
                <div class="group-block group-information">
                    <div class="group-block-header">
                        <h2 class="group-block-header__title active">О группе</h2>
                        <h2 class="group-block-header__title">Участники</h2>
                        <h2 class="group-block-header__title">Организаторы</h2>
                    </div>
                    <div class="group-block-content">
                        <div class="group-block-content__about">
                            <div class="group-block-content__item">
                                <h3 class="group-block-content__title">Описание:</h3>
                                <p class="group-block-content__description">
                                <?php
                                    echo $groupData['description'];
                                ?>
                                </p>
                            </div>

                            <div class="group-block-content__item">
                                <h3 class="group-block-content__title">Локация:</h3>
                                <span class="group-block-content__location">
                                <?php
                                    echo $groupData['location_country'];
                                ?>
                                </span>
                            </div>

                            <div class="group-block-content__item">
                                <h3 class="group-block-content__title">Категории:</h3>
                                <div class="group-block-content__categories">
                                    <?php
                                        echo $groupCategory['name'];
                                    ?>
                                </div>
                            </div>

                            <div class="group-block-content__item">
                                <h3 class="group-block-content__title">Топики:</h3>
                                <div class="group-block-content__topics event-topics__inner">
                                    <?php
                                        Core\View::render('includes/components/topics-list.php',
                                            [
                                                'topics' => $groupTopics,
                                                'inputType' => 'text',
                                                'column' => 'topics_name'
                                            ]
                                        );
                                    ?>
                                </div>
                            </div> <!-- /.group-block-content__item -->
                        </div> <!-- /.group-block-content__about -->

                        <div class="group-block-content__members">

                        </div>
                    </div> <!-- /.group-block-content -->
                </div> <!-- /.group-block -->
            </div> <!-- /.group__content -->
        </div> <!-- /.container -->
    </section>
    <!-- GROUP END -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php ROOT ?>/scripts/entityParticipation.js"></script>
</body>
</html>