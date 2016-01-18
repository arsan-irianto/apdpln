/**
 * Created by Arsan Irianto on 14/12/2015.
 */
function reloadDatatable(){
    if($("#cbo_month").val()!= ''){
        $('#tsaidi').DataTable({
            ajax: "modules/json_saidi.php?month="+$("#cbo_month").val()+"&year="+$("#cbo_year").val(),
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'colvis'
            ],
            columnDefs: [{
                text:"Change Columns",
                visible: false
            }],
            destroy: true,
            language: {
                zeroRecords: "Data Saidi bulan "+ $("#cbo_month").val()+" tahun " +$("#cbo_year").val() + " Kosong"
            }
        });
        $("#tsaidi_wrapper > .dt-buttons").appendTo("#btnTable");
        $("#btnPdf").attr("href", "reports/rpt_generator.php?name=saidi&type=pdf&month="+
        $("#cbo_month").val()+"&year="+$("#cbo_year").val());
    }
    else{
        $('#tsaidi').DataTable({
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'colvis'
            ],
            columnDefs: [{
                text:"Change Columns",
                visible: false
            }],
            destroy: true
        });
        $("#tsaidi_wrapper > .dt-buttons").appendTo("#btnTable");
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

    $("#DCCID").change(function(){
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax({
            type: "POST",
            url: "modules/list_area.php",
            data: dataString,
            cache: false,
            success: function(html){
                $("#AREAID").html(html);
            }
        })
    });


});
