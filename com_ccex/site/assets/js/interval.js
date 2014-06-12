$('#interval_duration').slider();
$('#interval_duration').on('slide', function(slideEvt) {
    $('#interval_duration_feedback').text(slideEvt.value);
    $('#fake_interval_duration').val(slideEvt.value);

    var input = $(this);
    var active = $('#collection_year_tabs').find('li.active > a');
    var values = active.text().split('-');
    var new_value = values[0].trim();

    if (slideEvt.value > 1) {
        new_value += '-' + (parseInt(values[0]) + slideEvt.value - 1);
    }

    active.text(new_value);
});


$('#interval_begin_year').on('input', function() {
    var input = $(this);
    var active = $('#collection_year_tabs').find('li.active > a');
    var values = active.text().split('-');
    var new_value = input.val().trim();
    if (new_value) {
        var new_int_val = parseInt(new_value);
        var duration = parseInt($('#interval_duration').text());

        if (duration > 1) {
            new_value += '-' + (new_int_val + duration - 1);
        }
    }
    active.text(new_value);
});
