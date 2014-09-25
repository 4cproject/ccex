$(document).ready(function() {
    jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value.indexOf(" ") < 0 && value != ""; 
    }, "No space please and don't leave it empty");

    $('form#configurationForm').validate({
        rules: {
            'configuration[name]': {
                required: true,
                blank: false,
            },
            'configuration[identifier]': {
                required: true,
                blank: false,
                noSpace: true
            },
            'configuration[value]': {
                required: true,
                blank: false,
            },
            'configuration[data_type]': {
                required: true,
                blank: false,
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
            var group = element.closest('.input-group');

            if (group.length) {
                error.insertAfter(group);
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

    $("#configuration_data_type").on("change", function(){
        $("#configuration_value").attr("type", $(this).val());
    });
});
