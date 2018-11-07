$( function() {
    $( "#templates" ).sortable();
} );
var arr = '';
$('#updater').click( function () {
    $('#templates li').each(function (index) {
        arr += $(this).attr('data-name')+',';
    });
    $('#parts').val(arr);
    // $.ajax({
    //     url: 'admin/editor/update-parts',
    //     type: 'POST',
    //     data: arr,
    //     success: function () {
    //         alert('tuer');
    //     }
    // });

});