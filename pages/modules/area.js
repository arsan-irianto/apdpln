/**
 * Created by Arsan Irianto on 12/12/2015.
 */

function reloadDataTable(){
    $('#tarea').DataTable({
        ajax: "modules/json_area.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ],
        destroy : true
    });
    $("#tarea_wrapper > .dt-buttons").appendTo("#btnTable");
}

function showModals( id ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_area.php",
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

function submitArea() {
    var formData = $("#form_area").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_area.php",
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
        url: "modules/crud_area.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDataTable();
            waitingDialog.hide();
        }
    });
    //clearModals();
}

function deleteArea( id ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_area.php",
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
    $("#AREAID").val("");
    $("#AREAID").attr('readonly',false);
    $("#AREA").val("");
    $("#JUMPENYULANG").val(0);
    $("#PANJANGPENYULANG").val(0);
    $("#DCCID").val("");
    $("#DESC").val("");
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#AREAID").val(data.AREAID);
    $("#AREAID").attr('readonly',true);
    $("#AREA").val(data.AREA.trim());
    JUMPENYULANG = (data.JUMPENYULANG == null) ? 0 : data.JUMPENYULANG;
    PANJANGPENYULANG = (data.PANJANGPENYULANG == null) ? 0 : data.PANJANGPENYULANG;
    $("#JUMPENYULANG").val(JUMPENYULANG);
    $("#PANJANGPENYULANG").val(PANJANGPENYULANG);
    $("#DCCID").val(data.DCCID);
    DESCR = (data.DESCR == null) ? "" : data.DESCR.trim();
    $("#DESC").val(DESCR);
    $("#myModals").modal("show");
}

$(document).ready(function(){
    reloadDataTable();
});

