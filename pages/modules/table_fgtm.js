/**
 * Created by Arsan Irianto on 07/12/2015.
 */
function reloadDatatable(){
    if($("#cbo_month").val()!= ''){
        $('#tfgtm').DataTable({
            ajax: "modules/json_table_fgtm.php?month="+$("#cbo_month").val()+"&year="+$("#cbo_year").val(),
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'colvis'
            ],
            columnDefs: [{
                text:"Change Columns",
                visible: false
            }],
            destroy: true,
            language: {
                zeroRecords: "Data FGTM bulan "+ $("#cbo_month").val()+" tahun " +$("#cbo_year").val() + " Kosong"
            }
        });
        $("#tfgtm_wrapper > .dt-buttons").appendTo("#btnTable");
        $("#btnPdf").attr("href", "reports/rpt_generator.php?name=fgtm&type=pdf&month="+
                            $("#cbo_month").val()+"&year="+$("#cbo_year").val());
    }
    else{
        $('#tfgtm').DataTable({
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'colvis'
            ],
            columnDefs: [{
                text:"Change Columns",
                visible: false
            }],
            destroy: true
        });
        $("#tfgtm_wrapper > .dt-buttons").appendTo("#btnTable");
    }
}

$(document).ready(function(){
    reloadDatatable();
    $("#cbo_month").change(function(){
        if($(this).val()!= ''){
            reloadDatatable();
        }
        else {alert("Choose Period Option");}
    });
});
