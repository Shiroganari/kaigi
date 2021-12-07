<?php
    $groupID = $groupData['groupID'];
    $groupTitle = $groupData['groupTitle'];
    $groupDescription = $groupData['groupDescription'];
    $groupCountry = $groupData['groupCountry'];
    $groupCity = $groupData['groupCity'];
    $groupCategory = $groupData['groupCategory'];
?>

<a class="group-item" href="/group/<?php echo $groupID?>">

    <div class="group-item__avatar">
        <img class="group-item__img" src="/images/mongol.jpg" alt="Group Picture">
    </div>

    <div class="group-item__information">
        <h3 class="group-item__title">
            <?php echo $groupTitle?>
        </h3>

        <?php if ($groupDescription): ?>
            <div class="group-item__description">
                <?php echo $groupDescription?>
            </div>
        <?php else: ?>
            <div class="group-item__description">Описание отсутствует</div>
        <?php endif ?>

        <div class="group-item__location">
            <?php
                if ($groupCountry) {
                    echo $groupCountry;

                    if ($groupCity != '') {
                        echo ', ' . $groupCity;
                    }
                } else {
                    echo 'Онлайн';
                }
            ?>
        </div>

        <div class="group-item__categories">
            <div class="group-item__subtitle">Категории:</div>
            <span><?php echo "$groupCategory"?></span>
        </div>
    </div>
</a>