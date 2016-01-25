/**
 * Created by Arsan Irianto on 24/01/2016.
 */

function reloadDatatable(){
    if($("#TANGGAL").val()!= ''){
        var dTable = $('#tbhp').DataTable({
            ajax: "modules/json_bhp.php?tanggal="+$("#TANGGAL").val(),
            deferRender: true,
            //processing:true,
            pagingType: "full_numbers",
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'colvis'
            ],
            columnDefs: [{
                text: "Change Columns",
                visible: false
            }],
            destroy: true,
            language: {
                zeroRecords: "Records Not Found"
            }
        });
        $("#tbhp_wrapper > .dt-buttons").appendTo("#btnTable");

        /*
         $('#tbhp tbody').on( 'click', '.btn_edit', function () {
         var data = dTable.row( $(this).parents('tr') ).data();
         alert(data[2]);
         });*/

    }
    else{
        $('#tbhp').DataTable({
            deferRender: true,
            pagingType: "full_numbers",
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'colvis'
            ],
            columnDefs: [{
                text: "Change Columns",
                visible: false
            }],
            destroy: true
        });
        $("#tbhp_wrapper > .dt-buttons").appendTo("#btnTable");
    }
}

$(function () {
    $("#tanggal_filter input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });
    reloadDatatable();
    $("#TANGGAL").change(function(){
        reloadDatatable();
    });
})
