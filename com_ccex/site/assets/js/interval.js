$( document ).ready(function() {
    $(".editable-field").on("click", function(){
        var volume = $("#interval_data_volume_number").val();
        var unit = $("#interval_data_volume_unit option:selected").text();
        var editableField = $(this);

        if (!isNaN(volume) && volume > 0){
            $(this).siblings(".editable-popup").find(".editable-input").after('<div style="display: inline-block;padding-top: 5px;margin-left: 5px;margin-right: 10px;font-size: 15px"><span>' + unit + '</span></div>');
        }
    });
});

$('#interval_duration').slider();
$('#interval_duration').on('slide', function(slideEvt) {
    $('#interval_duration_feedback').text(slideEvt.value);
    $('#fake_interval_duration').val(slideEvt.value);

    var input = $(this);
    var active = $('#collection_year_tabs').find('li.active > a');
    var values = active.contents().get(0).nodeValue.split('-');
    var new_value = values[0].trim();

    if (new_value && slideEvt.value > 1) {
        new_value += '-' + (parseInt(values[0]) + slideEvt.value - 1);
    }

    active.contents().get(0).nodeValue = new_value;
});

$('#interval_begin_year').on('input', function() {
    var input = $(this);
    var active = $('#collection_year_tabs').find('li.active > a');
    var values = active.contents().get(0).nodeValue.split('-');
    var new_value = input.val().trim();
    if (new_value) {
        var new_int_val = parseInt(new_value);
        var duration = parseInt($('#interval_duration').text());

        if (duration > 1) {
            new_value += '-' + (new_int_val + duration - 1);
        }
    }
    active.contents().get(0).nodeValue = new_value;
});

$('.close-tab').on('click', function(e){
    e.stopPropagation();
    e.preventDefault();

    if($(this).data('action') == 'close'){
        window.location.href = $(this).data('redirect');
    }
});

$('.close-tab').exists(function() {
    if($(this).data('action') != 'close'){
        $(this).confirmModal({
            confirmMessage   : 'Are you sure you want to delete this ' + $(this).data("type") + '? This action is irreversible.',
            confirmCallback  : callClose
        });
    }
});

function callClose(button){
    id = button.data("id");
    type = button.data("type");
    redirect = button.data("redirect");

    ccexDelete(type, id, redirect);
}
