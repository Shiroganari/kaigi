function getTopics(element) {
    $.ajax({
        url: '/topics/get-all-topics',
        method: 'POST',
        data: {
            category: element.val()
        },
        success: function(data) {
            var response = $.parseJSON(data);
            showTopics(element, response);
        }
    });
}

$('#entity-category').on('change', function() {
    getTopics($(this));
})

function showTopics(element, data) {
    $('.topics').empty();

    for (let i = 0; i < Object.keys(data).length; i++) {
        if (element.hasClass('select')) {
            $('<option>'+data[i]['name']+'</option>').appendTo('.topics');
        } else {
            let label = $('<div class="label-choice">').html("" +
                "<input class='label-choice__checkbox' name='entity-topics[]' type='checkbox' value='"+data[i]['name'] +"'>" +
                "<span class='label-choice__title'>"+data[i]['name']+"</span>");
            label.appendTo('.topics');
        }
    }
}