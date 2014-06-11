$("#interval_duration").slider();
$("#interval_duration").on('slide', function(slideEvt) {
    $("#interval_duration_feedback").text(slideEvt.value);
});
