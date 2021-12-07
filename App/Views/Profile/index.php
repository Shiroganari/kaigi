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
    <?php
        use App\Models\CategoriesModel;
        use App\Models\GroupsMembersModel;

        require_once(dirname(__DIR__) . LAYOUTS . 'header.php');
    ?>
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
                    <div class="profile-main-header" id="profile-main-header">
                        <div class="profile-main-header__title profile-main-header__title--description active">Описание</div>
                        <div class="profile-main-header__title profile-main-header__title--groups">Группы</div>
                    </div>

                    <div class="profile-main-content">
                        <p class="profile-main-content__item profile-main-content__item--description active">
                            <?php echo $user['description']?>
                        </p>

                        <div class="profile-main-content__item profile-main-content__item--groups">
                            <?php
                                foreach ($groups as $group) {
                                    $categoryInfo = CategoriesModel::getCategoryName($group['categories_id']);
                                    $groupMembers = GroupsMembersModel::countGroupMembers($group['id']);

                                    $groupData = [
                                        'groupID' => $group['id'],
                                        'groupTitle' => $group['title'],
                                        'groupDescription' => $group['description'],
                                        'groupCountry' => $group['location_country'],
                                        'groupCity' => $group['location_city'],
                                        'groupCategory' => $categoryInfo['name'],
                                        'groupMembersCount' => $groupMembers['COUNT(*)']
                                    ];

                                    \Core\View::render('includes/components/group-item.php', ['groupData' => $groupData]);
                                }
                            ?>
                        </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php ROOT ?>/scripts/profile.js"></script>
</body>
</html>