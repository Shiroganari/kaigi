$(document).ready(function () {
    filter_data();

    $('.event-filter').change(function () {
        filter_data();
    })

    function filter_data() {
        let eventTitle = $('.event-filter--title').val();
        let eventFormat = $('.event-filter--format').val();
        let eventCountry = $('.event-filter--country').val();
        let eventCity = $('.event-filter--city').val();
        let eventCategory = $('.event-filter--category').val();

        $.ajax({
            url: 'events/showEvents',
            method: 'POST',
            data: {
                eventTitle: eventTitle,
                eventFormat: eventFormat,
                eventCountry: eventCountry,
                eventCity: eventCity,
                eventCategory: eventCategory
            },
            success: function (data) {
                $('#events-content').html(data);
            }
        });
    }
})