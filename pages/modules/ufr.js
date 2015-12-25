/**
 * Created by Arsan Irianto on 24/12/2015.
 */

function reloadDatatable(){
    if($("#cbo_month").val()!= ''){
        $('#tufr').DataTable({
            ajax: "modules/json_ufr.php?month="+$("#cbo_month").val()+"&year="+$("#cbo_year").val()+"&wilayah="+$("#cbo_wilayah").val(),
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
                zeroRecords: "Data UFR bulan "+ $("#cbo_month").val()+" tahun " +$("#cbo_year").val() + " Kosong"
            },
            initComplete: function (settings, json) {
                this.api().columns('.sum').every(function () {
                    var column = this;

                    var sum = column
                        .data()
                        .reduce(function (a, b) {
                            return parseFloat(a) + parseFloat(b);
                        });
                    $(column.footer()).html(sum.toFixed(2));
                });
            }
        });
        $("#tufr_wrapper > .dt-buttons").appendTo("#btnTable");
        $("#btnPdf").attr("href", "reports/rpt_generator.php?name=ufr&type=pdf&month="+
        $("#cbo_month").val()+"&year="+$("#cbo_year").val()+"&wilayah="+$("#cbo_wilayah").val());


    }
    else{
        $('#tufr').DataTable({
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
        $("#tufr_wrapper > .dt-buttons").appendTo("#btnTable");
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

