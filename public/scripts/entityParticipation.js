// Join/Leave an event or group
$('#entity-participation').on('click', function () {
    let button = $(this);
    let url;
    let entity;

    if (button.hasClass('entity-participation--event')) {
        url = '/event/event-participation';
        entity = 'event';
    } else if (button.hasClass('entity-participation--group')) {
        url = '/group/group-participation';
        entity = 'group'
    } else {
        return;
    }

    let userID = parseInt($('#user-id').val());
    let entityID = parseInt($('#entity-id').val());
    let isMember = parseInt($('#is-member').val());
    let leaveEntity = false;
    let joinEntity = false;

    if (isMember && entity === 'event') {
        leaveEntity = confirm('Вы действительно хотите покинуть событие?');
    } else if (isMember && entity === 'group') {
        leaveEntity = confirm('Вы действительно хотите покинуть группу?');
    } else if (!isMember && entity === 'event') {
        joinEntity = confirm('Вы действительно хотите стать участником события?');
    } else if (!isMember && entity === 'group') {
        joinEntity = confirm('Вы действительно хотите вступить в группу?');
    }

    if (isMember && !leaveEntity) {
        return;
    }

    if (!isMember && !joinEntity) {
        return;
    }

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            userID: userID,
            entityID: entityID,
            entity: entity
        },
        success: function (response) {
            let result = response.replace(/"/g, '');

            if (result === 'Join') {
                $('#entity-participation').addClass('entity-participation--active');
                $('#entity-participation').html('Вы участник');
                $('#is-member').attr('value', '1');
            } else {
                $('#entity-participation').removeClass('entity-participation--active');
                $('#entity-participation').html('Стать участником');
                $('#is-member').attr('value', '0');
            }
        }
    });
})