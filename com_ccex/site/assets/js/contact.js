$('form#contactForm').validate({
    rules: {
        'message': {
            required: true,
            blank: false,
            minlength: 50
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
