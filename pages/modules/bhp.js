/**
 * Created by Arsan Irianto on 30/01/2016.
 */
function reloadDataTable(){
    if($("#TANGGAL_BHP").val()!= ''){
        var dTable = $('#tbhp').DataTable({
            ajax: "modules/json_bhp.php?tanggal="+$("#TANGGAL_BHP").val(),
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

function showModals( pid,tgl,hour ){
    waitingDialog.show();
    // Untuk Eksekusi Data Yang Ingin di Edit
    if( pid && tgl && hour ){
        $.ajax({
            type: "POST",
            url: "modules/crud_bhp.php",
            dataType: 'json',
            data: {pid:pid,tgl:tgl,hour:hour,type:"get"},
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

function submitBHP() {
    var formData = $("#form_bhp").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_bhp.php",
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

function deleteBHP( pid,tgl,hour ) {
    $.ajax({
        type: "POST",
        url: "modules/crud_bhp.php",
        dataType: 'json',
        data: {pid:pid,tgl:tgl,hour:hour,type:"get"},
        success: function(data) {
            $('#delModal').modal('show');
            $('#delpid').val(pid);
            $('#deltanggal').val(tgl);
            $('#delhour').val(hour);
            waitingDialog.hide();
        }
    });
}

function submitDelete() {
    var formData = $("#form_delete").serialize();
    waitingDialog.show();
    $.ajax({
        type: "POST",
        url: "modules/crud_bhp.php",
        dataType: 'json',
        data: formData,
        success: function(data){
            reloadDataTable();
            waitingDialog.hide();
        }
    });
    //clearModals();
}

function clearModals() {
    $("#PID").val("");
    $("#FEEDERNAME").val("");
    $("#GIPID").val("");
    $("#GI").val("");
    $("#AREAID").val("");
    $("#AREA").val("");
    $("#DCCID").val("");
    $("#DCC").val("");
    //$("#TANGGAL").val("");
    $("#HOUR").val("");
    $("#VALUE").val(0);
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#PID").val(data.PID);
    FEEDERNAME = (data.FEEDERNAME == null) ? "" : data.FEEDERNAME.trim();
    $("#FEEDERNAME").val(data.FEEDERNAME);
    $("#GIID").val(data.GIID);
    GI = (data.GI == null) ? "" : data.GI.trim();
    $("#GI").val(GI);
    $("#AREAID").val(data.AREAID);
    AREA = (data.AREA == null) ? "" : data.AREA.trim();
    $("#AREA").val(AREA);
    $("#DCCID").val("");
    DCC = (data.DCC == null) ? "" : data.DCC.trim();
    $("#DCC").val(DCC);
    $("#TANGGAL").val(data.TANGGAL);
    $("#HOUR").val(data.HOUR);
    $("#VALUE").val(data.VALUE);
    $("#myModals").modal("show");
}

$(function () {
    $("#tanggal_filter input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });
    $("#tanggal_check input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });
    reloadDataTable();
    $("#TANGGAL_BHP").change(function(){
        reloadDataTable();
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
                    $("#GIID").val(data.GIID);
                    $("#GI").val(data.GI.trim());
                    $("#AREAID").val(data.AREAID);
                    $("#AREA").val(data.AREA.trim());
                    $("#DCCID").val(data.DCCID.trim());
                    $("#DCC").val(data.DCC.trim());
                }
            });
        },
        ajax: {
            url: "modules/crud_logsheet.php?ref=plbsrecgh",
            displayField: "NAME",
            valueField:"PID"
        }
    });
})
