<?php

$memberID = $userData['id'];
$firstName = $userData['first_name'];
$lastName = $userData['last_name'];
$username = $userData['username'];
$locationCountry = $userData['location_country'];
$locationCity = $userData['location_city'];

$senderID = null;
$isSender = null;

if (isset($_SESSION['userID'])) {
    $senderID = $_SESSION['userID'];
}

if ($memberID ===  $senderID) {
    $isSender = true;
}

?>

<a class="member-item" href="/user/<?php echo $memberID; ?>">
    <div class="member-item__avatar">
        <img class="member-item__img" src="/images/mongol.jpg" alt="member Picture">
    </div>

    <div class="member-item__information">
        <div class="member-item__name">
            <?php echo $firstName . ' ' . $lastName; ?>
        </div>

        <div class="member-item__username">
            <?php echo $username; ?>
        </div>

        <div class="member-item__location">
            <?php
                echo $locationCountry;

                if ($locationCity != '') {
                    echo ', ' . $locationCity;
                }
            ?>
        </div>

        <?php if ($organizerPrivileges and !$isSender): ?>
        <button class="member-item__kick button" onClick="kickMember(event, '<?php echo $memberID; ?>');">
            Исключить пользователя
        </button>
        <?php endif; ?>
    </div>

    <?php
        if (!$isSender) {
            \Core\View::render('component:report-button',
                [
                    'reportType' => 'user',
                    'nickname' => $username,
                    'userID' => $senderID
                ]);
        }
    ?>
</a>
