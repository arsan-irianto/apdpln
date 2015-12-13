/**
 * Created by Arsan Irianto on 12/12/2015.
 */
$(document).ready(function(){
    $('#tarea').DataTable({
        ajax: "modules/json_area.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ]
    });
    $("#tarea_wrapper > .dt-buttons").appendTo("#btnTable");
});

