<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaigi | Профиль</title>
    <link rel="stylesheet" href="/styles/pages/profile/profile.css">
</head>
<body>
    <!-- HEADER -->
    <?php require_once(dirname(__DIR__) . LAYOUTS . 'header.php'); ?>
    <!-- HEADER END -->

    <!-- PROFILE -->
    <section class="profile">
        <div class="container">
            <div class="profile__inner">
                <div class="profile-about">
                    <div class="profile-about__item profile-about__photo" style="width: 100px; height: 100px;">
                        <img class="profile-about__img" src="<?php ROOT?>/images/mongol.jpg" alt="Photo">
                    </div>

                    <div class="profile-about__item profile-about__username">
                        <?php echo $user['username']; ?>
                    </div>

                    <div class="profile-about__item profile-about__name">
                        <?php
                            echo $user['first_name'];
                            echo ' ';
                            echo $user['last_name'];
                        ?>
                    </div>

                    <div class="profile-about__item profile-about__location">
                        <span>Локация: </span>
                        <?php
                            echo $user['location_city'] . ', ' . $user['location_country'];
                        ?>
                    </div>
                </div> <!-- /.profile-about -->

                <div class="profile-main">
                    <div class="profile-main__header" id="profile-main__header">
                        <div class="profile-main__title profile-main__title--descr active">Описание</div>
                        <div class="profile-main__title profile-main__title--groups">Группы</div>
                        <div class="profile-main__title profile-main__title--events">Посещенные события</div>
                    </div>

                    <div class="profile-main__content">
                        <p class="profile-main__descr">
                            <?php echo $user['description']?>
                        </p>
                    </div>
                </div> <!-- /.profile-main -->
            </div> <!-- /.profile__inner -->

            <div class="profile-topics">
                <h2 class="profile-topics__subtitle">Увлекается: </h2>

                <div class="profile-topics__inner">
                    <?php
                        \Core\View::render('includes/components/topics-list.php',
                            [
                                'topics' => $userTopics,
                                'column' => 'topic_name',
                                'inputType' => 'text'
                            ]
                        );
                    ?>
                </div>
            </div> <!-- /.profile-topics -->
        </div> <!-- /.container -->
    </section>
    <!-- PROFILE END -->

    <script src="<?php ROOT ?>/scripts/profile.js"></script>
</body>
</html>