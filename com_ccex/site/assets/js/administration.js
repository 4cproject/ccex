$(document).ready(function() {
    $('form#euroconvertionrateForm').validate({
        rules: {
            'conversion[year]': {
                required: true,
                blank: false,
                number: true
            },
            'conversion[tax]': {
                required: true,
                blank: false,
                number: true
            },
            'conversion[code]': {
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
        }
    });
});
