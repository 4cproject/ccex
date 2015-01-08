function ccexUpdate(model, redirect_url, silent, update_redirect, success_message) {
    ccexSave(model, 'edit', redirect_url, silent, update_redirect, success_message);
}

function ccexCreate(model, redirect_url, silent, update_redirect, success_message) {
    ccexSave(model, 'add', redirect_url, silent, update_redirect, success_message);
}

function ccexSave(model, action, redirect_url, silent, update_redirect, success_message) {
    if (!ccexValidateForm(model, silent)) {
        return;
    }

    $("#_message_container").hide();
    $("#_message_container").children().empty();

    var form = $("#" + model + "Form");
    var info = form.serializeArray();

    if (typeof window["ccexSave" + capitalize(model)] != 'undefined') {
        info = window["ccexSave" + capitalize(model)](info);
    }

    $.ajax({
        url: 'index.php?option=com_ccex&controller=' + action + '&format=raw&model=' + capitalize(model) + '&view=' + capitalize(model) + '&layout=' + action,
        type: 'POST',
        data: info,
        dataType: 'JSON',
        success: function(data) {            
                if (data.success) {
                    if (success_message) {
                        $("#_message_container").removeClass("alert-success alert-danger");
                        $("#_message_container").addClass("alert-success");
                        $("#_message_container #_message").text(data.message);
                        $("#_message_container").show();
                    }

                    if (update_redirect && typeof window["ccexSaveUpdateRedirect" + capitalize(model)] != 'undefined') {
                        redirect_url = window["ccexSaveUpdateRedirect" + capitalize(model)](data, redirect_url, update_redirect);
                    }

                    if (typeof window["ccexSaveUpdate" + capitalize(model)] != 'undefined') {
                        window["ccexSaveUpdate" + capitalize(model)]();
                    }

                    if (redirect_url) {
                        if(redirect_url == 'reload'){
                            window.location.reload();
                        }else{
                            if(typeof history.pushState !== "undefined" && action == 'add' && typeof window["ccexFakeHistory" + capitalize(model)] != 'undefined'){
                                history.pushState({}, model,  window["ccexFakeHistory" + capitalize(model)](data));
                            }

                            window.location.href = redirect_url;
                        }
                    }

                } else {
                    $("#_message_container").removeClass("alert-success alert-danger");
                    $("#_message_container").addClass("alert-danger");
                    $("#_message_container #_message").text(data.message);
                    $("#_message_container").show();
                }
            }
    });
}

function ccexDelete(type, id, redirect){
    $.ajax({
        url: 'index.php?option=com_ccex&controller=delete&format=raw&tmpl=component',
        type: 'POST',
        data: type+'_id='+id+'&type='+type,
        dataType: 'JSON',
        success:function(data){
            if(data.success){
                window.location.href = redirect;
            }
        }
    });
}

function ccexValidateForm(model, silent) {
    if (!$('#' + model + 'Form').validate().form()) {
        if (!silent) {
            $("#_message_container").hide();
            $("#_message_container").removeClass("alert-success alert-danger");
            $("#_message_container").addClass("alert-danger");
            $("#_message_container #_message").text("Please fill or review highlighted fields");
            $("#_message_container").show();
        }

        return false;
    }
    return true;
}

function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

$('#delete-button').exists(function() {
    $(this).confirmModal({
        confirmMessage   : 'Are you sure you want to delete this ' + ($(this).attr("data-name") ? $(this).data("name") : $(this).data("type")) + '? This action is irreversible.',
        confirmCallback  : callDelete
    });
});

function callDelete(){
    button = $('#delete-button');

    id = button.data("id");
    type = button.data("type");
    redirect = button.data("redirect");

    ccexDelete(type, id, redirect);
}
