$(document).ready(function () {
    filter_data();

    $('.event-filter').on('change input', function () {
        filter_data();
    })

    function filter_data() {
        let eventTitle = $('.event-filter--title').val();
        let eventFormat = $('.event-filter--format').val();
        let eventCountry = $('.event-filter--country').val();
        let eventCity = $('.event-filter--city').val();
        let eventCategory = $('.event-filter--category').val();
        let myEvents = $('.event-filter--my-events').val();
        let isOrganizer = $('.event-filter--organizer').is(':checked');

        $.ajax({
            url: 'events/showEvents',
            method: 'POST',
            data: {
                eventTitle: eventTitle,
                eventFormat: eventFormat,
                eventCountry: eventCountry,
                eventCity: eventCity,
                eventCategory: eventCategory,
                myEvents: myEvents,
                isOrganizer: isOrganizer
            },
            success: function (data) {
                $('#events-content').html(data);
            }
        });
    }
})