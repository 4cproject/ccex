$(document).ready(function() {
    $('form#costForm').validate({
        rules: {
            'cost[name]': {
                required: true,
                blank: false
            },
            'cost[cost]': {
                required: true,
                blank: false,
                number: true,
                min: 0.01
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

    $("#cost_value").on("input", function(){
        var value = $(this).val();
        var tax = parseFloat($("#tax").val());

        if($("#cost-converted").length){
            if(value != "" && !isNaN(value)){
                value = parseFloat(value) * tax;
                $("#cost-euro").text(value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $("#cost-converted").show();
            }else{
                $("#cost-converted").hide();
            }
        }
    });
});

function updateCost(redirect_url) {
    saveCost(redirect_url, 'edit');
}

function createCost(redirect_url) {
    saveCost(redirect_url, 'add');
}

function saveCost(redirect_url, controller) {
    if (!validateCostForm()) {
        return;
    }
    var costInfo = {};

    $("#_message_container").hide();
    $("#_message_container").children().empty();

    $("#costForm :input").each(function(idx, ele) {
        costInfo[jQuery(ele).attr('name')] = jQuery(ele).val();
    });

    $.ajax({
        url: 'index.php?option=com_ccex&controller=' + controller + '&format=raw&model=Cost&view=Cost&layout=' + controller,
        type: 'POST',
        data: costInfo,
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

function validateCostForm() {
    if (!$('#costForm').validate().form()) {
        $("#_message_container").hide();
        $("#_message_container").removeClass("alert-success alert-danger");
        $("#_message_container").addClass("alert-danger");

        $("#_message_container #_message").text("Error saving cost");
        $("#_message_container #_description").text("Please check errors");
        $("#_message_container").show();

        return false;
    }
    return true;
}
