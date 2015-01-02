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
            },
            'interval[staff]': {
                required: true,
                blank: false,
                number: true,
                min: 0.1
            }
        },
        messages: {
            'interval[data_volume_number]': {
                number: "Please enter a valid number, the decimal separator is a dot.",
            },
            'interval[staff]': {
                number: "Please enter a valid number, the decimal separator is a dot.",
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
        },
        invalidHandler: function(form, validator) {
            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top - 100
            }, "fast");
        }
    });
});

function ccexSaveUpdateRedirectCollection(data, redirect_url, addID){
    if(redirect_url){
        if(addID == "collection"){
            return redirect_url + data.collection_id;
        }else if(addID == "interval"){
            return redirect_url + data.interval_id;
        }
        
    }

    return redirect_url;
}
function ccexFakeHistoryCollection(data){
    return "/compare-costs?view=collection&layout=edit&collection_id=" + data.collection_id;
}
