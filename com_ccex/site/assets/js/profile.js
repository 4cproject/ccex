$(document).ready(function() {
    $('form#profileForm').validate({
        rules: {
            'organization[name]': {
                required: true,
                blank: false
            },
            'profile[data_volume_number]': {
                required: true,
                blank: false,
                number: true,
                min: 1
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
    var org_type_name = $("#profileForm #organization_type option:selected").text();
    if (org_type_name == "Other") {
        $("#organisation_type_other_container").show();
    } else {
        $("#organisation_type_other_container").hide();
    }
}

function updateProfile(redirect_url) {
    saveProfile(redirect_url, 'edit');
}

function saveProfile(redirect_url, controller) {
    if (!validateProfileForm()) {
        return;
    }

    var profileInfo = {};

    $("#_message_container").hide();
    $("#_message_container").children().empty();

    $("#profileForm :input").each(function(idx, ele) {
        profileInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
    });

    if ($('input[name="organization[linked_cost_data]"]').is(':checked')) {
        profileInfo['organization[linked_cost_data]'] = 1;
    } else {
        profileInfo['organization[linked_cost_data]'] = 0;
    }

    if ($('input[name="organization[linked_data_provider]"]').is(':checked')) {
        profileInfo['organization[linked_data_provider]'] = 1;
    } else {
        profileInfo['organization[linked_data_provider]'] = 0;
    }

    profileInfo['organization[share_information]'] = $('input[name="organization[share_information]"]:checked').val();
    profileInfo['organization[share_data]'] = $('input[name="organization[share_data]"]:checked').val();

    $.ajax({
        url: 'index.php?option=com_ccex&controller=' + controller + '&format=raw&model=Profile&view=Profile&layout=' + controller,
        type: 'POST',
        data: profileInfo,
        dataType: 'JSON',
        success: function(data) {
            $("#_message_container").removeClass("alert-success alert-danger");

            if (data.success) {
                $("#_message_container").addClass("alert-success");
            } else {
                $("#_message_container").addClass("alert-danger");
                $("#_message_container #_description").text("Please check errors");
            }

            $("#_message_container #_message").text(data.message);
            $("#_message_container").show();

            if (redirect_url) {
                var delay = 700;
                setTimeout(function() {
                    window.location.href = redirect_url;
                }, delay);
            }
        }
    });
}

function validateProfileForm() {
    if (!$('#profileForm').validate().form()) {
        $("#_message_container").hide();
        $("#_message_container").removeClass("alert-success alert-danger");
        $("#_message_container").addClass("alert-danger");

        $("#_message_container #_message").text("Error saving profile");
        $("#_message_container #_description").text("Please check errors");
        $("#_message_container").show();

        return false;
    }
    return true;
}
