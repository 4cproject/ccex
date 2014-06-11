function ccexUpdate(model, redirect_url) {
    ccexSave(model, 'edit', redirect_url);
}

function ccexCreate(model, redirect_url) {
    ccexSave(model, 'add', redirect_url);
}

function ccexSave(model, action, redirect_url) {
    if (!ccexValidateForm(model)) {
        return;
    }

    $("#_message_container").hide();
    $("#_message_container").children().empty();

    var form = $("#" + model + "Form");
    var info = form.serialize();

    if (typeof window["ccexSave" + capitalize(model)] != 'undefined') {
        info = window["ccexSave" + capitalize(model)](info);
    }

    $.ajax({
        url: 'index.php?option=com_ccex&controller=' + action + '&format=raw&model=' + capitalize(model) + '&view=' + capitalize(model) + '&layout=' + action,
        type: 'POST',
        data: info,
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
                var delay = 500;
                setTimeout(function() {
                    window.location.href = redirect_url;
                }, delay);
            }
        }
    });
}

function ccexValidateForm(model) {
    if (!$('#' + model + 'Form').validate().form()) {
        $("#_message_container").hide();
        $("#_message_container").removeClass("alert-success alert-danger");
        $("#_message_container").addClass("alert-danger");

        if (model == 'organization') {
            $("#_message_container #_message").text("Error saving profile");
        } else {
            $("#_message_container #_message").text("Error saving " + model);
        }

        $("#_message_container #_description").text("Please check errors");
        $("#_message_container").show();

        return false;
    }
    return true;
}

function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
