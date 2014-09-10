// function getURLParameter(name) {
//   return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
// }

// var interval = getURLParameter('interval');

// if (hash) {
//     $('.nav-tabs a[href=#interval' + getURLParameter('interval') + ']').tab('show');
// } 

$(".onoffswitch-checkbox").on("change", function() {
    var final = 0;
    var checkbox = $(this);
    var checked = checkbox.is(":checked");
    var form = checkbox.closest("form");
    var data = form.serializeArray();

    $.ajax({
        url: 'index.php?option=com_ccex&controller=draft&format=raw',
        type: 'POST',
        data: data,
        dataType: 'JSON',
        success: function(data) {
            if (!data.success) {
                checkbox.prop("checked", !checked);
            }
            
            if (data.readyForComparison) {
                $(".analyse-check-ready").show();
            } else {
                $(".analyse-check-ready").hide();
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            checkbox.prop("checked", !checked);
        }
    });
});
