$(document).ready(function() {
    jQuery.validator.addMethod("durationCoverDefinedYears", function(value, element) {
        var value = parseInt($('#interval_begin_year').val()) + parseInt(value) - 1;
        var valid = true;
        var links = $('#collection_year_tabs').find('li > a.year-tab');

        links.each(function() {
            var values = $(this).text().split('-');
            var begin_year = parseInt(values[0]);

            if (value == begin_year) {
                valid = false;
            } else if (typeof values[1] != 'undefined') {
                var end_year = parseInt(values[1]);
                if (value >= begin_year && value <= end_year) {
                    valid = false;
                }
            }
        });

        return this.optional(element) || valid;
    }, "* Specified duration covers already defined year");

    jQuery.validator.addMethod("yearAlreadyDefined", function(value, element) {
        var value = parseInt(value);
        var valid = true;
        var links = $('#collection_year_tabs').find('li > a.year-tab');

        links.each(function() {
            var values = $(this).text().split('-');
            var begin_year = parseInt(values[0]);

            if (value == begin_year) {
                valid = false;
            } else if (typeof values[1] != 'undefined') {
                var end_year = parseInt(values[1]);
                if (value >= begin_year && value <= end_year) {
                    valid = false;
                }
            }
        });

        return this.optional(element) || valid;
    }, "* Year already defined");

    $('form#collectionForm').validate({
        ignore: [],
        rules: {
            'collection[name]': {
                required: true,
                blank: false
            },
            'interval[begin_year]': {
                required: true,
                blank: false,
                number: true,
                min: 1950,
                max: 2050,
                yearAlreadyDefined: true
            },
            'fake_interval[duration]': {
                durationCoverDefinedYears: true
            },
            'interval[data_volume_number]': {
                required: true,
                blank: false,
                number: true,
                min: 1
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});

function ccexSaveUpdateURLCollection(data, redirect_url){
    if(redirect_url && data.response){
        return redirect_url + data.response;
    }

    return redirect_url;
}
