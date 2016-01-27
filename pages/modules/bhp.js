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

function showModals( id ){
    waitingDialog.show();
    //clearModals();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_bhp.php",
            dataType: 'json',
            data: {id:id,type:"get"},
            success: function(res) {
                waitingDialog.hide();
                setModalData( res );
                //$("#LAMAconv").val(lm);
            }
        });
    }
    // Form Add new
    else{
        //clearModals();
        $("#myModals").modal("show");
        //$("#myModalLabel").html("New User");
        $("#type").val("new");
        waitingDialog.hide();
    }
}

$(function () {

    $("#tanggal_check input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });

    $("#tanggal_filter input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });
    reloadDatatable();
    $("#TANGGAL").change(function(){
        reloadDatatable();
    });

    $("input.typeahead").typeahead({
        onSelect: function(item) {
            $("#PID").val(item.value);
            $.ajax({
                type: "GET",
                url: "modules/crud_bhp.php?plb=garea",
                dataType: 'json',
                data: "id=" + $("#PID").val(),
                success: function(data) {
                    $("#GIPID").val(data.GIID);
                    $("#GI").val(data.GI.trim());
                    $("#AREAID").val(data.AREAID);
                    $("#AREA").val(data.AREA.trim());
                    $("#DCCID").val(data.DCCID.trim());
                    $("#DCC").val(data.DCC.trim());
                }
            });
        },
        ajax: {
            url: "modules/crud_bhp.php?ref=feeder",
            displayField: "NAME",
            valueField:"PID"
        }
    });

    $("input.typeahead_gi").typeahead({
        onSelect: function(item) {
            $("#GIPID").val(item.value);
        },
        ajax: {
            url: "modules/crud_bhp.php?r=gi",
            displayField: "NAME",
            valueField:"ID"
        }
    });

    $("input.typeahead_area").typeahead({
        onSelect: function(item) {
            $("#AREAID").val(item.value);
            $.ajax({
                type: "GET",
                url: "modules/crud_bhp.php?g=dcc",
                dataType: 'json',
                data: "id=" + $("#AREAID").val(),
                success: function(data) {
                    $("#DCC").val(data.DCC.trim());
                }
            });
        },
        ajax: {
            url: "modules/crud_bhp.php?a=area",
            displayField: "NAME",
            valueField:"ID"
        }
    });
})
