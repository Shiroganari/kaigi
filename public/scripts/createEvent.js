$(document).ready(function() {
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd'
    });

    $(function() {
        $("#event-date" ).datepicker();
    });

    $('#event-time').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '6',
        maxTime: '11:00pm',
        defaultTime: '11',
        startTime: '6:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    let stepCount = 1;

    $('.step-button').click(function() {
        let action = $(this).attr('id');
        $(".new-event__step").removeClass('active');
        $('#next-step').css('display', 'inline-block');
        $('#previous-step').css('display', 'inline-block');

        if (action === 'next-step' && stepCount < 5) {
            stepCount++;
        } else if (stepCount > 1) {
            stepCount--;
        }

        switch (stepCount) {
            case 1:
                $('.progress-bar__item--first, .new-event__step--first').addClass('active');
                $('.progress-bar__item--first').next().removeClass('active');
                $('#previous-step').css('display', 'none');
                break;
            case 2:
                $('.progress-bar__item--second, .new-event__step--second').addClass('active');
                $('.progress-bar__item--second').next().removeClass('active');
                break;
            case 3:
                $('.progress-bar__item--third, .new-event__step--third').addClass('active');
                $('.progress-bar__item--third').next().removeClass('active');
                break;
            case 4:
                $('.progress-bar__item--fourth, .new-event__step--fourth').addClass('active');
                $('.progress-bar__item--fourth').next().removeClass('active');
                break;
            case 5:
                $('.progress-bar__item--fifth, .new-event__step--fifth').addClass('active');
                $('.progress-bar__item--fifth').next().removeClass('active');
                $('#next-step').css('display', 'none');
                break;
        }
    })

    $('.event-format').on('click', function() {
        let formatName = $(this).val();

        if (formatName === 'Офлайн') {
            $('.new-event-content__location').css('display', 'flex');
        } else {
            $('.new-event-content__location').css('display', 'none');
        }
    })
})
