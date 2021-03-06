let url = $('#url').val();

function showPopup(event, reportType, nickname) {
    event.preventDefault();
    let senderID = $('#user-id').val();

    $('body').addClass('lock');

    $('body').append
    (
        '<form class="popup popup--report active" method="POST" action="/report/send-report">' +
            '<div class="popup__container">' +
                '<div class="popup__title">Составление жалобы</div>' +
                '<p class="popup__subtitle">Укажите причину жалобы:</p>' +
                '<textarea id="report-data__description" class="popup__description form__textarea" name="description" id="" cols="30" rows="10"></textarea>' +
                '<input id="report-data__sender" name="senderID" type="text" hidden>' +
                '<input id="report-data__nickname" name="nickname" type="text" hidden>' +
                '<input id="report-data__type" name="report-type" type="text" hidden>' +
                '<input id="report-data__url" name="url" type="text" hidden>' +
                '<button class="popup__button button form__button send-report">Отправить жалобу</button>' +
                '<div class="toggle-button close-report active" id="close-report">' +
                    '<div class="toggle-button__item"></div>' +
                    '<div class="toggle-button__item"></div>' +
                    '<div class="toggle-button__item"></div>' +
                '</div>' +
            '</div>' +
        '</form>'
    );

    $('#report-data__sender').val(senderID);
    $('#report-data__type').val(reportType);
    $('#report-data__nickname').val(nickname);
    $('#report-data__url').val(url);

    $('.close-report').on('click', function () {
        $('.popup--report').removeClass('active');
        $('body').removeClass('lock');
    })

    $('.send-report').on('click', function () {
        $('.popup--report').removeClass('active');
        $('body').removeClass('lock');
        alert('Ваша жалоба была успешно отправлена!');
    })
}