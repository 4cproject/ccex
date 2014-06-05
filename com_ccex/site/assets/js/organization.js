$(document).ready(function() {
    $('form#organizationForm').validate({
        rules: {
            'organization[name]': {
                required: true,
                blank: false
            },
            'organization[other_org_type]': {
                required: requiredOrganizationType()
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

function requiredOrganizationType() {
    var org_type_name = $("#organization_type option:selected").text();
    if (org_type_name == "Other") {
        return true;
    } else {
        return false;
    }
}

function changeOrganizationTpe() {
    var org_type_name = $("#organization_type option:selected").text();
    if (org_type_name == "Other") {
        $("#organisation_type_other_container").show();
    } else {
        $("#organisation_type_other_container").hide();
    }
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

    info['organization[share_information]'] = $('input[name="organization[share_information]"]:checked').val();
    info['organization[share_data]'] = $('input[name="organization[share_data]"]:checked').val();

    return info;
}
