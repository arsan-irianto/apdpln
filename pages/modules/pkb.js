/**
 * Created by Arsan Irianto on 17/12/2015.
 */

function reloadDataTable(){
    $('#tpkb').DataTable({
        ajax: "modules/json_pkb.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ],
        destroy: true,
        language: {
            zeroRecords: "Records Not Found"
        }
    });
    $("#tpkb_wrapper > .dt-buttons").appendTo("#btnTable");
}

function showModals( id ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_pkb.php",
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

function submitPkb() {
    var formData = $("#form_pkb").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_pkb.php",
        dataType: 'json',
        data: formData,
        success: function(data) {
            reloadDataTable();
            waitingDialog.hide();
        }
    });
}

function submitDelete() {
    var formData = $("#form_delete").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_pkb.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDatatable();
            waitingDialog.hide();
        }
    });
    //clearModals();
}

function deletePkb( id ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_pkb.php",
        dataType: 'json',
        data: {id:id,type:"get"},
        success: function(data) {
            $('#delModal').modal('show');
            $('#delid').val(id);
            waitingDialog.hide();
        }
    });
}

function clearModals() {
    $("#BULAN").val("");
    $("#TAHUN").val("");
    $("#DCCID").val("");
    $("#AREAID").val("");
    $("#TOTALPELANGGAN").val(0);
    $("#KWHRATARATAHARIANPELANGGAN").val(0);
    $("#KWHRATARATAJAMPELANGGAN").val(0);
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#PKEY").val(data.PKEY);
    $("#BULAN").val(data.BULAN);
    $("#TAHUN").val(data.TAHUN);
    $("#DCCID").val(data.DCCID);
    $("#AREAID").val(data.AREAID);
    $("#TOTALPELANGGAN").val(data.TOTALPELANGGAN);
    $("#KWHRATARATAHARIANPELANGGAN").val(data.KWHRATARATAHARIANPELANGGAN);
    $("#KWHRATARATAJAMPELANGGAN").val(data.KWHRATARATAJAMPELANGGAN);
    $("#myModals").modal("show");
}

$(function () {
    reloadDataTable();
});

