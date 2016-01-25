/**
 * Created by Arsan Irianto on 24/01/2016.
 */

function reloadDataTable(){
    $('#tpelanggan').DataTable({
        ajax: "modules/json_pelanggan.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ],
        destroy : true
    });
    $("#tpelanggan_wrapper > .dt-buttons").appendTo("#btnTable");
}

function showModals( id ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_pelanggan.php",
            dataType: 'json',
            data: {id:id,type:"get"},
            success: function(res) {
                waitingDialog.hide();
                setModalData( res );
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

function submitPelanggan() {
    var formData = $("#form_pelanggan").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_pelanggan.php",
        dataType: 'json',
        data: formData,
        success: function(data) {
            if(data=="OK"){
                reloadDataTable();
            }
            else{alert(data);}
            waitingDialog.hide();
        }
    });
}

function submitDelete() {
    var formData = $("#form_delete").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_pelanggan.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDataTable();
            waitingDialog.hide();
        }
    });
    //clearModals();
}

function deletePelanggan( id ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_pelanggan.php",
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
    $("#PKEY").val("");
    $("#PKEY").attr('readonly', false);
    $("#AREAID").val("");
    $("#KODEORDER").val("");
    $("#PIDFEEDER").val("");
    $("#FEEDER").val("");
    $("#SEGMEN").val("");
    $("#PELANGGAN").val(0);
    $("#KET").val("");
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#PKEY").val(data.PKEY);
    $("#PKEY").attr('readonly', true);
    $("#AREAID").val(data.AREAID);
    $("#KODEORDER").val(data.KODEORDER);
    $("#PIDFEEDER").val(data.PIDFEEDER);
    $("#FEEDER").val(data.FEEDER);
    $("#SEGMEN").val(data.SEGMEN);
    $("#PELANGGAN").val(data.PELANGGAN);
    $("#KET").val(data.KET);
    $("#myModals").modal("show");
}
$(document).ready(function(){
    reloadDataTable();
    var a;
    $("input.typeahead").typeahead({
        onSelect: function(item) {
            $('input[name="PIDFEEDER"]').val(item.value);
        },
        ajax: {
            url: "modules/crud_pelanggan.php?ref=feeder",
            displayField: "NAME",
            valueField:"ID"
        }
    });

    $("#SEGMEN").focus(function(){
        a = ($('input[name="PIDFEEDER"]').val());

        $("input.typeahead1").typeahead({
            ajax: {
                url: "modules/crud_pelanggan.php?segmen=pid&pidfeeder="+a,
                displayField: "NAME"
            }
        });
    })

});
