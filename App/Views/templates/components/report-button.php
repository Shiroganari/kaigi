<?php
    $redirectURL = null;
    $onClickAction = null;

    if (!isset($userID)) {
        $redirectURL = '/login';
        $onClickAction = "window.location='" . $redirectURL . "'";
    } else {
        $onClickAction = "showPopup(event, '$reportType', '$nickname');";
    }
?>

<button class="report-button user-report" onClick="<?php echo $onClickAction; ?>">
    <span class="report-button__item"></span>
    <span class="report-button__item"></span>
    <span class="report-button__item"></span>
</button>