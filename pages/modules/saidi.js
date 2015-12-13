/**
 * Created by Arsan Irianto on 14/12/2015.
 */
$(document).ready(function(){
    $('#tsaidi').DataTable({
        ajax: "modules/json_saidi.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ]
    });
    $("#tsaidi_wrapper > .dt-buttons").appendTo("#btnTable");
});
