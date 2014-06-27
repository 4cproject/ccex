$(document).ready(function() {
    jQuery.validator.addMethod("otherOrgType", function(value, element) {

        var visible = $("#organisation_type_other_container").is(":visible");

        return !visible || value;
    }, "* This field is required.");

    jQuery.validator.addMethod("orgType", function(value, element) {

        var selected = $("#organisation_type_container input:checked").length;

        return selected;
    }, "* Select at least one type.");

    $('form#organizationForm').validate({
        rules: {
            'organization[name]': {
                required: true,
                blank: false
            },
            'organization[other_org_type]': {
                otherOrgType: true
            },
            'organization[country_id]': {
                required: true
            },
            'organization[currency_id]': {
                required: true
            },
            'org_type[]': {
                orgType: true
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

function ccexSaveOrganization(info) {
    if ($('input[name="organization[global_comparison]"]').is(':checked')) {
        info.push({name: "organization[global_comparison]", value: 1});
    } else {
        info.push({name: "organization[global_comparison]", value: 0});
    }

    if ($('input[name="organization[peer_comparison]"]').is(':checked')) {
        info.push({name: "organization[peer_comparison]", value: 1});
    } else {
        info.push({name: "organization[peer_comparison]", value: 0});
    }

    if ($('input[name="organization[contact_and_sharing]"]').is(':checked')) {
        info.push({name: "organization[contact_and_sharing]", value: 1});
    } else {
        info.push({name: "organization[contact_and_sharing]", value: 0});
    }

    if ($('input[name="organization[snapshots]"]').is(':checked')) {
        info.push({name: "organization[snapshots]", value: 1});
    } else {
        info.push({name: "organization[snapshots]", value: 0});
    }

    return info;
}
