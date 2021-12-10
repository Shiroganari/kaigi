$(document).ready(function () {
    filter_data();

    $('.groups-filter').change(function () {
        filter_data();
    })

    function filter_data() {
        let groupsTitle = $('.groups-filter--title').val();
        let groupsCountry = $('.groups-filter--country').val();
        let groupsCity = $('.groups-filter--city').val();
        let groupsCategory = $('.groups-filter--category').val();

        $.ajax({
            url: 'groups/showGroups',
            method: 'POST',
            data: {
                groupsTitle: groupsTitle,
                groupsCountry: groupsCountry,
                groupsCity: groupsCity,
                groupsCategory: groupsCategory
            },
            success: function (data) {
                $('#groups-content').html(data);
            }
        });
    }
})