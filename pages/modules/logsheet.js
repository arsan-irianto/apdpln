/**
 * Created by Arsan Irianto on 05/12/2015.
 */

function reloadDatatable(){
    if($("#cbo_month").val()!= ''){
        var dTable = $('#tlogsheet').DataTable({
            ajax: "modules/json_table_logsheet.php?month="+$("#cbo_month").val()+"&year="+$("#cbo_year").val(),
            deferRender: true,
            processing:true,
            pagingType: "full_numbers",
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'print', 'colvis'
            ],
            columnDefs: [{
                text: "Change Columns",
                visible: false
            }],
            destroy: true
        });
        $("#tlogsheet_wrapper > .dt-buttons").appendTo("#btnTable");

        $('#tlogsheet tbody').on( 'click', '.btn_edit', function () {
            var data = dTable.row( $(this).parents('tr') ).data();
            $("#LAMAconv").val(data[12]);
        });
    }
    else{
        $('#tlogsheet').DataTable({
            deferRender: true,
            pagingType: "full_numbers",
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'print', 'colvis'
            ],
            columnDefs: [{
                text: "Change Columns",
                visible: false
            }],
            destroy: true
        });
        $("#tlogsheet_wrapper > .dt-buttons").appendTo("#btnTable");
    }
}

function showModals( id ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_logsheet.php",
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
        clearModals();
        $("#myModals").modal("show");
        //$("#myModalLabel").html("New User");
        $("#type").val("new");
        waitingDialog.hide();
    }
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#ID").val(data.ID);
    $("#SC").val(data.SC);
    $("#MC").val(data.MC);
    $("#CHK").val(data.CHK);
    //tgl = data.TANGGAL.substr(0,10);
    $("#TANGGAL").val(data.TANGGAL.substr(0,10));
    $("#PLBSREC").val(data.PLBSREC);
    //$("#PLBSREC").attr('readonly',true);
    $("#ASUHAN").val(data.ASUHAN);
    $("#AREA").val(data.AREA);
    $("#GIPID").val(data.GIPID);
    $("#BEBANPADAM").val(data.BEBANPADAM);
    $("#OE").val(data.OE);
    $("#CE").val(data.CE);
    $("#EOT").val(data.EOT);
    $("#ECT").val(data.ECT);
    $("#OO").val(data.OO);
    $("#CO").val(data.CO);
    $("#OT").val(data.OT);
    $("#CT").val(data.CT);
    $("#AE").val(data.AE);
    $("#DE").val(data.DE);
    $("#AT").val(data.AT);
    $("#DT").val(data.DT);
    $("#AR").val(data.AR);
    $("#DR").val(data.DR);
    TR = (data.TR == null) ? "" : data.TR.substr(0,19);
    EX = (data.EX == null) ? "" : data.EX.substr(0,19);
    RC = (data.RC == null) ? "" : data.RC.substr(0,19);
    OP = (data.OP == null) ? "" : data.OP.substr(0,19);
    CL = (data.CL == null) ? "" : data.CL.substr(0,19);
    $("#TR").val(TR);
    $("#EX").val(EX);
    $("#RC").val(RC);
    $("#OP").val(OP);
    $("#CL").val(CL);
    $("#RELAY").val(data.RELAY);
    $("#LAMA").val(data.LAMA);
    //$("#LAMAconv").val(data.a2);
    $("#KWH").val(data.KWH);
    $("#MRF").val(data.MRF);
    $("#JEDARC1").val(data.JEDARC1);
    $("#KODEFGTM").val(data.KODEFGTM);
    $("#KETFGTM").val(data.KETFGTM);
    $("#KETERANGAN").val(data.KETERANGAN);
    $("#KORDINASI").val(data.KORDINASI);
    $("#SEGMENGANGGUAN").val(data.SEGMENGANGGUAN);
    $("#TOTALPELANGGAN").val(data.TOTALPELANGGAN);
    $("#PELANGGANPADAM").val(data.PELANGGANPADAM);
    $("#PERSENPELANGGANPADAM").val(data.PERSENPELANGGANPADAM);
    $("#KODESAIDI").val(data.KODESAIDI);
    $("#KETSAIDI").val(data.KETSAIDI);
    $("#EKSEKUTOR").val(data.EKSEKUTOR);
    $("#SHIFT").val(data.SHIFT);
    $("#myModals").modal("show");
    ("#RELAY").trigger("focus");
}

//Submit Untuk Eksekusi Tambah/Edit/Hapus Data
function submitLogsheet() {
    var formData = $("#form_logsheet").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_logsheet.php",
        dataType: 'json',
        data: formData,
        success: function(data) {
            reloadDatatable();
            waitingDialog.hide();
        }
    });
}

function submitDelete() {
    var formData = $("#form_delete").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_logsheet.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDatatable();
            waitingDialog.hide();
        }
    });
    //clearModals();

}

function deleteLogsheet( id ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_logsheet.php",
        dataType: 'json',
        data: {id:id,type:"get"},
        success: function(data) {
            $('#delModal').modal('show');
            $('#delid').val(id);
            waitingDialog.hide();
        }
    });
}

function clearModals()
{
    $("#ID").val("");
    $("#SC").val(1);
    $("#MC").val(1);
    $("#CHK").val(1);
    $("#TANGGAL").val("");
    $("#PLBSREC").val("");
    //$("#PLBSREC").attr('readonly',false);
    $("#ASUHAN").val("");
    $("#AREA").val("");
    $("#GIPID").val("");
    $("#BEBANPADAM").val(0);
    $("#OE").val(1);
    $("#CE").val("");
    $("#EOT").val("");
    $("#ECT").val("");
    $("#OO").val("");
    $("#CO").val("");
    $("#OT").val("");
    $("#CT").val("");
    $("#AE").val(0);
    $("#DE").val(0);
    $("#AT").val("");
    $("#DT").val("");
    $("#AR").val("");
    $("#DR").val("");
    $("#TR").val("");
    $("#EX").val("");
    $("#RC").val("");
    $("#OP").val("");
    $("#CL").val("");
    $("#RELAY").val("");
    $("#LAMA").val(0);
    $("#LAMAconv").val("");
    $("#KWH").val(0);
    $("#MRF").val("");
    $("#JEDARC1").val("");
    $("#KODEFGTM").val("");
    $("#KETERANGAN").val("");
    $("#KORDINASI").val("");
    $("#SEGMENGANGGUAN").val("");
    $("#TOTALPELANGGAN").val(0);
    $("#PELANGGANPADAM").val(0);
    $("#PERSENPELANGGANPADAM").val(0);
    $("#KODESAIDI").val("");
    $("#KETSAIDI").val("");
    $("#EKSEKUTOR").val("");
    $("#SHIFT").val("");
}

$(function () {
    $('.modal').on('hidden.bs.modal',function(e){
        $(this).removeData('bs.modal');
    })
    $("#RELAY").focus(function(){
        $.ajax({
            type: "GET",
            url: "modules/crud_logsheet.php?diff=yes",
            dataType: 'json',
            data: "op=" + $("#OP").val() + "&cl=" + $("#CL").val(),
            success: function(data) {
                $("#LAMA").val(data.a1);
                $("#LAMAconv").val(data.a2);
            }
        });
    });

    $("#PELANGGANPADAM").blur(function(){
        $.ajax({
            type: "GET",
            url: "modules/crud_logsheet.php?c=persen",
            dataType: 'json',
            data: "tp=" + $("#TOTALPELANGGAN").val() + "&pp=" + $("#PELANGGANPADAM").val(),
            success: function(data) {
                $("#PERSENPELANGGANPADAM").val(data);
            }
        });
    })

    $("#KODEFGTM").change(function(){
        $("#KETFGTM").val($("#KODEFGTM :selected").text());
    });
    $("#KODESAIDI").change(function(){
        $("#KETSAIDI").val($("#KODESAIDI :selected").text());
    });
    $("#tanggal_check input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });
    $('.dttime').datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss'
    });

    reloadDatatable();
    $("#cbo_month").change(function(){
        if($(this).val()!= ''){
            reloadDatatable();
        }
        else {alert("Choose Month & Year Option");}
    });
});