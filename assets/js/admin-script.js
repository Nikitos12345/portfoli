$(function () {
    $("#templates").sortable({
        update: function () {
            updateList();
            alert("Порядок успешно изменен");
        }
    });

});

function updateList() {
    var arr = {};
    $('#templates li').each(function (index) {
        arr[index] = $(this).attr('data-name');
    });

    $.post('/admin/editor/update-parts', arr, function (e) {
    });
}

// $('#updater').click( function () {
//     $('#templates li').each(function (index) {
//         arr += $(this).attr('data-name')+',';
//     });
//     $('#parts').val(arr);
//     console.log(arr);
//     $.ajax({
//         url: 'admin/editor/update-parts',
//         type: 'POST',
//         data: arr,
//         success: function () {
//             console.log()
//             alert('tuer');
//         }
//     });
//
// });