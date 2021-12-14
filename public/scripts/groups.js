$(document).ready(function () {
    filter_data();

    $('.groups-filter').on('change input', function () {
        filter_data();
    })

    function filter_data() {
        let groupsTitle = $('.groups-filter--title').val();
        let groupsCountry = $('.groups-filter--country').val();
        let groupsCity = $('.groups-filter--city').val();
        let groupsCategory = $('.groups-filter--category').val();
        let myGroups = $('.groups-filter--my-groups').val();
        let isOrganizer = $('.groups-filter--organizer').is(':checked');

        $.ajax({
            url: 'groups/showGroups',
            method: 'POST',
            data: {
                groupsTitle: groupsTitle,
                groupsCountry: groupsCountry,
                groupsCity: groupsCity,
                groupsCategory: groupsCategory,
                myGroups: myGroups,
                isOrganizer: isOrganizer
            },
            success: function (data) {
                $('#groups-content').html(data);
            }
        });
    }
})