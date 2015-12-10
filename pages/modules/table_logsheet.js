/**
 * Created by Arsan Irianto on 25/11/2015.
 */
function showModal(){
    $(".alertdel").click(function(){
        var id = $(this).attr("id");
        $('#test').modal('show');
        $('#delid').val(id);
    });
}
$(function () {
    var $_GET = {};

    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
        function decode(s) {
            return decodeURIComponent(s.split("+").join(" "));
        }

        $_GET[decode(arguments[1])] = decode(arguments[2]);
    });

    //alert($_GET['periode']);

    if( ($_GET['periode']) != 'null') {
        $('#tlogsheet').DataTable({
            ajax: "modules/json_table_logsheet.php?periode=" + $_GET['periode'],
            deferRender: true,
            pagingType: "full_numbers",
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            buttons: [
                'copy', 'csv', 'excel', 'print', 'colvis'
            ],
            columnDefs: [{
                targets: -1,
                text: "Change Columns",
                visible: false
            }],
            destroy: true
        });
    }else{
        $('#tlogsheet').DataTable({
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            buttons: [
                'copy', 'csv', 'excel', 'print', 'colvis'
            ],
            columnDefs: [{
                targets: -1,
                text: "Change Columns",
                visible: false
            }],
            destroy: true
        });
    }
    $("#tlogsheet_wrapper > .dt-buttons").appendTo("#btnTable");
    $("#sPeriod").change(function(){
        if($(this).val()!= ''){
            $('#tlogsheet').DataTable({
                ajax: "modules/json_table_logsheet.php?periode="+$("#sPeriod").val(),
                deferRender: true,
                pagingType: "full_numbers",
                dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
                scrollX: true,
                buttons: [
                    'copy', 'csv', 'excel', 'print', 'colvis'
                ],
                columnDefs: [{
                    targets: -1,
                    text: "Change Columns",
                    visible: false
                }],
                destroy: true
            });
            $("#tlogsheet_wrapper > .dt-buttons").appendTo("#btnTable");
        }
        else {alert("Choose Period Option");}
    });


});
