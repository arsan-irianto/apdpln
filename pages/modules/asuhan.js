/**
 * Created by Arsan Irianto on 12/12/2015.
 */

function reloadDataTable(){
    $('#tasuhan').DataTable({
        ajax: "modules/json_asuhan.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ],
        destroy : true
    });
    $("#tasuhan_wrapper > .dt-buttons").appendTo("#btnTable");
}

function showModals( id ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_asuhan.php",
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

function submitAsuhan() {
    var formData = $("#form_asuhan").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_asuhan.php",
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
        url: "modules/crud_asuhan.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDataTable();
            waitingDialog.hide();
        }
    });
    //clearModals();
}

function deleteAsuhan( id ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_asuhan.php",
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
    $("#ASUHANID").val("");
    $("#ASUHANID").attr('readonly', false);
    $("#SCADANAME").val("");
    $("#NAME").val("");
    $("#AREAID").val("");
    $("#GIID").val("");
    $("#GI").val("");
    $("#PANJANGPENYULANG").val(0);
    $("#TYPE").val("");
    $("#DESC").val("");
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#ASUHANID").val(data.ASUHANID);
    $("#ASUHANID").attr('readonly', true);
    $("#SCADANAME").val(data.SCADANAME.trim());
    $("#NAME").val(data.NAME.trim());
    $("#AREAID").val(data.AREAID);
    $("#GIID").val(data.GIID);
    $("#GI").val(data.GI.trim());
    PANJANGPENYULANG = (data.PANJANGPENYULANG == null) ? 0 : data.PANJANGPENYULANG;
    $("#PANJANGPENYULANG").val(PANJANGPENYULANG);
    $("#TYPE").val(data.TYPE);
    DESCR = (data.DESCR == null) ? "" : data.DESCR.trim();
    $("#DESC").val(DESCR);
    $("#myModals").modal("show");
}

$(document).ready(function(){
    reloadDataTable();

    $("input.typeahead").typeahead({
        onSelect: function(item) {
            $("#GIID").val(item.value);
        },
        ajax: {
            url: "modules/crud_asuhan.php?ref=gi",
            displayField: "NAME",
            valueField:"ID"
        }
    });
});

