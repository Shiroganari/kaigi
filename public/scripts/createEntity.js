$(document).ready(function() {
    let stepCount = 1;

    $('.entity-data').on('input change', function () {
        console.log($(this))
        if ($(this).val() != '') {
            $('.step-button--next, .create-entity').addClass('active');
            $('.step-button--next, .create-entity').attr('disabled', false);
        } else {
            $('.step-button--next, .create-entity').removeClass('active');
            $('.step-button--next, .create-entity').attr('disabled', true);
        }
    })

    $('.step-button').click(function() {
        let action = $(this).attr('id');
        $(".new-entity__step").removeClass('active');
        $('#next-step').css('display', 'inline-block');
        $('#previous-step').css('display', 'inline-block');
        $('.step-button--next, .create-entity').removeClass('active');
        $('.step-button--next, .create-entity').attr('disabled', true);

        if (action === 'next-step' && stepCount < 5) {
            stepCount++;
        } else if (stepCount > 1) {
            stepCount--;
        }

        switch (stepCount) {
            case 1:
                $('.progress-bar__item--first, .new-entity__step--first').addClass('active');
                $('.progress-bar__item--first').next().removeClass('active');
                $('#previous-step').css('display', 'none');
                break;
            case 2:
                $('.progress-bar__item--second, .new-entity__step--second').addClass('active');
                $('.progress-bar__item--second').next().removeClass('active');
                break;
            case 3:
                $('.progress-bar__item--third, .new-entity__step--third').addClass('active');
                $('.progress-bar__item--third').next().removeClass('active');
                break;
            case 4:
                $('.progress-bar__item--fourth, .new-entity__step--fourth').addClass('active');
                $('.progress-bar__item--fourth').next().removeClass('active');
                if ($('.new-entity__step--fourth').hasClass('last-step')) {
                    $('#next-step').css('display', 'none');
                }
                break;
            case 5:
                $('.progress-bar__item--fifth, .new-entity__step--fifth').addClass('active');
                $('.progress-bar__item--fifth').next().removeClass('active');
                if ($('.new-entity__step--fifth').hasClass('last-step')) {
                    $('#next-step').css('display', 'none');
                }
                break;
        }
    })

    $('.entity-format').on('click', function() {
        let formatName = $(this).val();

        if (formatName === 'Офлайн') {
            $('.new-entity-content__location').css('display', 'flex');
        } else {
            $('.new-entity-content__location').css('display', 'none');
        }
    })
})
