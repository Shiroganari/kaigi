// Become an event member
$('#join-event').on('click', function() {
    let userID = parseInt($('#user-id').val());
    let eventID = parseInt($('#event-id').val());
    let isMember = parseInt($('#is-member').val());
    let leaveGroup = false;
    let joinGroup = false;

    if (isMember) {
        leaveGroup = confirm('Вы действительно хотите покинуть событие?');
    } else {
        joinGroup = confirm('Вы действительно хотите стать участником события?');
    }

    if (isMember && !leaveGroup) {
        return;
    }

    if (!isMember && !joinGroup) {
        return;
    }

    $.ajax({
        url: '/events/event-participation',
        method: 'POST',
        data: {
            userID: userID,
            eventID: eventID
        },
        success: function(response) {
            let result = response.replace(/"/g, '');

            if (result === 'Join') {
                $('#join-event').addClass('join-event--active');
                $('#join-event').html('Вы участвуете');
                $('#is-member').attr('value', '1');
            } else {
                $('#join-event').removeClass('join-event--active');
                $('#join-event').html('Стать участником');
                $('#is-member').attr('value', '0');
            }
        }
    });
})