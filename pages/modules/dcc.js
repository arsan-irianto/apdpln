/**
 * Created by Arsan Irianto on 12/12/2015.
 */

function reloadDataTable(){
    $('#tdcc').DataTable({
        ajax: "modules/json_dcc.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ],
        destroy: true
    });
    $("#tdcc_wrapper > .dt-buttons").appendTo("#btnTable");
}

function showModals( id ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_dcc.php",
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

function submitDcc() {
    var formData = $("#form_dcc").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_dcc.php",
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
        url: "modules/crud_dcc.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDataTable();
            waitingDialog.hide();
        }
    });
    //clearModals();
}

function deleteDcc( id ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_dcc.php",
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
    $("#DCCID").val("");
    $("#DCC").val("");
    $("#DESC").val("");
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#DCCID").val(data.DCCID);
    $("#DCC").val(data.DCC.trim());
    DESCR = (data.DESCR == null) ? "" : data.DESCR.trim();
    $("#DESC").val(DESCR);
    $("#myModals").modal("show");
}

$(function () {
    reloadDataTable();
});
