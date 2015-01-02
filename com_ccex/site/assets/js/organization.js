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
        },
        invalidHandler: function(form, validator) {
            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top - 100
            }, "fast");
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

    function clearAllData() {
        $.ajax({
            url: 'index.php?option=com_ccex&controller=clearalldata&format=raw',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                if (data.success) {
                    window.location.href = '/';
                }
            }
        });
    }

    $('#clear-all-data').exists(function() {
        $(this).confirmModal({
            confirmMessage: 'Are you sure you want to clear all data including your Organisation, Cost data sets, Years and Costs? This action is irreversible.',
            confirmCallback: clearAllData
        });
    });
});

function ccexSaveOrganization(info) {
    if ($('input[name="organization[global_comparison]"]').is(':checked')) {
        info.push({
            name: "organization[global_comparison]",
            value: 1
        });
    } else {
        info.push({
            name: "organization[global_comparison]",
            value: 0
        });
    }

    if ($('input[name="organization[peer_comparison]"]').is(':checked')) {
        info.push({
            name: "organization[peer_comparison]",
            value: 1
        });
    } else {
        info.push({
            name: "organization[peer_comparison]",
            value: 0
        });
    }

    if ($('input[name="organization[organization_linked]"]').is(':checked')) {
        info.push({
            name: "organization[organization_linked]",
            value: 1
        });
    } else {
        info.push({
            name: "organization[organization_linked]",
            value: 0
        });
    }

    if ($('input[name="organization[contact_and_sharing]"]').is(':checked')) {
        info.push({
            name: "organization[contact_and_sharing]",
            value: 1
        });
    } else {
        info.push({
            name: "organization[contact_and_sharing]",
            value: 0
        });
    }

    if ($('input[name="organization[snapshots]"]').is(':checked')) {
        info.push({
            name: "organization[snapshots]",
            value: 1
        });
    } else {
        info.push({
            name: "organization[snapshots]",
            value: 0
        });
    }

    return info;
}

function ccexFakeHistoryOrganization(data){
    return "/compare-costs?view=organization&layout=edit&organization_id=" + data.organization_id;
}
