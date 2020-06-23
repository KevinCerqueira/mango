// $(function () {
//     $('[data-toggle="popover"]').popover();
// });
// // $('.popover-dismiss').popover({
// //     trigger: 'focus'
// // });
$('#edit-description').on('shown.bs.modal', function () {
    $('#btn-edit').trigger('focus');
});
$('#turn-my-posts').on('click', e => {
    if($('#turn-my-posts').attr('status') == 'off'){
        $('.not-my-post').attr('hidden', 'true');
        $('#turn-my-posts').attr('status', 'on');
    }else{
        $('.not-my-post').removeAttr('hidden');
        $('#turn-my-posts').attr('status', 'off');
    }
});