<?php

    $groupID = $groupData['id'];
    $title = $groupData['title'];
    $description = $groupData['description'];
    $country = $groupData['country'];
    $city = $groupData['city'];
    $categoryTitle = $groupData['categoryTitle'];
    $membersCount = $groupData['membersCount'];

?>

<a class="group-item" href="/group/<?php echo $groupID; ?>">

    <div class="group-item__avatar">
        <img class="group-item__img" src="/images/mongol.jpg" alt="Group Picture">
    </div>

    <div class="group-item__information">
        <h3 class="group-item__title">
            <?php
            echo $title ?>
        </h3>

        <?php
        if ($description): ?>
            <div class="group-item__description">
                <?php
                echo $description ?>
            </div>
        <?php
        else: ?>
            <div class="group-item__description">Описание отсутствует</div>
        <?php
        endif ?>

        <div class="group-item__location">
            <?php
            if ($country) {
                echo $country;

                if ($city != '') {
                    echo ', ' . $city;
                }
            } else {
                echo 'Онлайн';
            }
            ?>
        </div>

        <div class="group-item__members">
            Количество участников:
            <?php
            echo ' ' . $membersCount;
            ?>
        </div>

        <div class="group-item__categories">
            <div class="group-item__subtitle">Категории:</div>
            <span><?php
                echo "$categoryTitle" ?></span>
        </div>
    </div>
</a>