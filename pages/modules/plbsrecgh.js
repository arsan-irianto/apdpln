/**
 * Created by Arsan Irianto on 12/12/2015.
 */

function reloadDataTable(){
    $('#tplbsrecgh').DataTable({
        ajax: "modules/json_plbsrecgh.php",
        pagingType: "full_numbers",
        dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
        scrollX: true,
        buttons: [
            'copy', 'csv', 'excel'
        ],
        destroy:true
    });
    $("#tplbsrecgh_wrapper > .dt-buttons").appendTo("#btnTable");
}

function showModals( id ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( id ){
        $.ajax({
            type: "POST",
            url: "modules/crud_plbsrecgh.php",
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

function submitPlbsrecgh() {
    var formData = $("#form_plbsrecgh").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_plbsrecgh.php",
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
        url: "modules/crud_plbsrecgh.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDatatable();
            waitingDialog.hide();
        }
    });
    //clearModals();
}

function deletePlbsrecgh( id ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_plbsrecgh.php",
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
    $("#PID").val(0);
    $("#STPOINTNAME").val("");
    $("#ANALOGID").val(0);
    $("#ANPOINTNAME").val("");
    $("#RTUID").val(0);
    $("#RTUNAME").val("");
    $("#NAME").val("");
    $("#NORMALLYCLOSED").val(0);
    $("#ASUHANID1").val(0);
    $("#ASUHANID2").val(0);
    $("#GIID").val(0);
    $("#AREAID").val(0);
    $("#DESC").val("");
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#PID").val(data.PID);
    $("#STPOINTNAME").val(data.STPOINTNAME.trim());
    $("#ANALOGID").val(data.ANALOGID);

    ANPOINTNAME=(data.ANPOINTNAME == null) ? "" : data.ANPOINTNAME;
    RTUID=(data.RTUID == null) ? 0 : data.RTUID;
    $("#ANPOINTNAME").val(ANPOINTNAME.trim());
    $("#RTUID").val(RTUID);

    RTUNAME =  (data.RTUNAME == null) ? "" : data.RTUNAME;
    NAME =  (data.NAME == null) ? "" : data.NAME;
    $("#RTUNAME").val(RTUNAME.trim());
    $("#NAME").val(NAME.trim());

    NORMALLYCLOSED = (data.NORMALLYCLOSED == null) ? 0 : data.NORMALLYCLOSED;
    ASUHANID1 = (data.ASUHANID1 == null) ? 0 : data.ASUHANID1;
    ASUHANID2 = (data.ASUHANID2 == null) ? 0 : data.ASUHANID2;
    GIID = (data.GIID == null) ? 0 : data.GIID;
    AREAID = (data.AREAID == null) ? 0 : data.AREAID;
    $("#NORMALLYCLOSED").val(NORMALLYCLOSED);
    $("#ASUHANID1").val(ASUHANID1);
    $("#ASUHANID2").val(ASUHANID2);
    $("#GIID").val(GIID);
    $("#AREAID").val(AREAID);

    DESCR = (data.DESCR == null) ? "" : data.DESCR.trim();
    $("#DESC").val(DESCR);
    $("#myModals").modal("show");
}

$(document).ready(function(){
    reloadDataTable();
});

