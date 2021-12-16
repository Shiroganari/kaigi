let url = $('#url').val();
let excludeUrl = url.split('/');
let entityType = excludeUrl[1];
let entityID = excludeUrl[2];

function kickMember(event, userID) {
    event.preventDefault();

    let methodUrl;

    if (entityType === 'event') {
        methodUrl = '/event/kick-member';
    } else if (entityType === 'group') {
        methodUrl = '/group/kick-member';
    }


    $.ajax({
        url: methodUrl,
        method: 'POST',
        data: {
            userID: userID,
            entityID: entityID
        },
        success: function () {
            event.target.closest('.member-item').remove();
        }
    });
}



function showPopup(event, reportType, nickname) {
    event.preventDefault();
    let senderID = $('#user-id').val();
    console.log(url);

    $('body').addClass('lock');

    $('body').append
    (
        '<form class="popup popup--report active" method="POST" action="/report/create-report">' +
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