$(document).ready(function() {
    $('form#organizationForm').validate({
        rules: {
            'organization[name]': {
                required: true,
                blank: false
            },
            'organization[other_org_type]': {
                required: requiredOrganizationType(),
                blank: blankOrganizationType(),
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

    $('.org-type-checkbox:checkbox').change(function() {
        var org_type_name = $(this)[0].nextSibling.nodeValue.trim();
        if (org_type_name == "Other") {
            if ($(this).is(':checked')) {
                $("#organisation_type_other_container").show();
            } else {
                $("#organisation_type_other_container").hide();
            }
        }
    });
});

function requiredOrganizationType() {
    if ($("#organisation_type_other_container").is(":visible")) {
        return true;
    } else {
        return false;
    }
}

function blankOrganizationType() {
    return !requiredOrganizationType();
}

function ccexSaveOrganization(info) {
    if ($('input[name="organization[linked_cost_data]"]').is(':checked')) {
        info['organization[linked_cost_data]'] = 1;
    } else {
        info['organization[linked_cost_data]'] = 0;
    }

    if ($('input[name="organization[linked_data_provider]"]').is(':checked')) {
        info['organization[linked_data_provider]'] = 1;
    } else {
        info['organization[linked_data_provider]'] = 0;
    }

    return info;
}
