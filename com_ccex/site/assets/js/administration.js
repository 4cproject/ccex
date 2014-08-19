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

$('#delete-button').exists(function() {
    $(this).confirmModal({
        confirmMessage   : 'Are you sure you want to delete this ' + $(this).data("type") + '? This action is irreversible.',
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
