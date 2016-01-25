/**
 * Created by Arsan Irianto on 05/12/2015.
 */

function exportWindow(){
    window.open("modules/excel_logsheet.php", "Export Logsheet to Excel", "width=1100, height=500, scrollbars=yes");
}

function reloadDatatable(){
    if($("#TANGGAL_LOGSHEET").val()!= ''){
        var dTable = $('#tlogsheet').DataTable({
            ajax: "modules/json_table_logsheet.php?tanggal="+$("#TANGGAL_LOGSHEET").val(),
            deferRender: true,
            //processing:true,
            pagingType: "full_numbers",
            dom: "B<'row'<'col-sm-8'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-12'>>" + "<'row'<'col-sm-8'><'col-sm-4'>>tipr",
            scrollX: true,
            buttons: [
                'copy', 'colvis'
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
        $("#tlogsheet_wrapper > .dt-buttons").appendTo("#btnTable");

        /*
        $('#tlogsheet tbody').on( 'click', '.btn_edit', function () {
            var data = dTable.row( $(this).parents('tr') ).data();
            alert(data[2]);
        });*/

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

function disabledInput(){
    $("#tab_1").find("input").prop('readonly', true);
    $("#tab_2").find("input").prop('readonly', true);
}


function showModals( id ){
    waitingDialog.show();
    clearModals();
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
        //clearModals();
        $("#myModals").modal("show");
        //$("#myModalLabel").html("New User");
        $("#type").val("new");
        waitingDialog.hide();
    }
    if($("#usertype").val()==3){
        disabledInput();
    }
}

//Show Data to edit
function setModalData( data ){
    $("#type").val("edit");
    $("#ID").val(data.ID);
    $("#KODESIKLUS").val(data.KODESIKLUS);
    $("#SC").val(data.SC);
    $("#MC").val(1);
    $("#CHK").val(1);
    $("#PID").val(data.PID);
    //tgl = data.TANGGAL.substr(0,10);
    $("#TANGGAL").val(data.TANGGAL.substr(0,10));
    $("#PLBSRECGH").val(data.PLBSREC.trim());
    //$("#PLBSREC").attr('readonly',true);
    $("#ASUHAN").val(data.ASUHAN.trim());
    $("#AREA").val(data.AREA.trim());
    $("#AREAID").val(data.AREAID);
    $("#GIPID").val(data.GIPID);
    $("#GI").val(data.GI.trim());
    $("#WILAYAH").val(data.WIL.trim());
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
    $("#RELAY").val(data.RELAY.trim());
    $("#LAMA").val(data.LAMA);
    //$("#LAMAconv").val(data.a2);
    $("#KWH").val(data.KWH);
    $("#MRF").val(data.MRF.trim());
    $("#JEDARC1").val(data.JEDARC1);
    $("#KODEFGTM").val(data.KODEFGTM);
    $("#KFGTM").val(data.KETFGTM.trim());
    $("#KETFGTM").val(data.KODEFGTM.trim());
    $("#KETERANGAN").val(data.KETERANGAN.trim());
    $("#KORDINASI").val(data.KORDINASI.trim());
    SEGMENGANGGUAN = (data.SEGMENGANGGUAN == null) ? "" : data.SEGMENGANGGUAN;
    $("#SEGMENGANGGUAN_manual").val(SEGMENGANGGUAN.trim());
    $("#SEGMENGANGGUAN").val(SEGMENGANGGUAN.trim());
    $("#TOTALPELANGGAN").val(data.TOTALPELANGGAN);
    $("#PELANGGANPADAM").val(data.PELANGGANPADAM);
    $("#PERSENPELANGGANPADAM").val(data.PERSENPELANGGANPADAM);
    $("#KODESAIDI").val(data.KODESAIDI);
    $("#KETSAIDI").val(data.KETSAIDI.trim());
    $("#EKSEKUTOR").val(data.EKSEKUTOR.trim());
    $("#SHIFT").val(data.SHIFT.trim());
    $("#myModals").modal("show");
    //("#RELAY").trigger("focus");
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
    //clearModals();
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
    $('#chkAuto').prop("checked",false);
    $("#PID").val("");
    $("#KODESIKLUS").val("");
    $("#ID").val("");
    $("#SC").val(1);
    $("#MC").val(1);
    $("#CHK").val(1);
    $("#TANGGAL").val("");
    $("#PLBSRECGH").val("");
    $("#GI").val("");
    $("#AREAID").val("");
    $("#WILAYAH").val("");
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
    //$("#LAMAconv").val("");
    $("#KWH").val(0);
    $("#MRF").val("");
    $("#JEDARC1").val("");
    $("#KODEFGTM").val("");
    $("#KFGTM").val("");
    $("#KETERANGAN").val("");
    $("#KORDINASI").val("");
    $("#PIDSEGMEN1").val("");
    $("#PIDSEGMEN2").val("");
    $("#JMLSEGMEN1").val("");
    $("#JMLSEGMEN2").val("");
    //$("#SEGMENGANGGUAN1").val("");
    //$("#SEGMENGANGGUAN2").val("");
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

    $('#sgm').hide();
    //$('#KODEFGTM').select2();
    $('#SEGMENGANGGUAN_auto').select2();
    $('#KODESAIDI').select2();
    $('#penyulang').select2();


    $("#KODEKELOMPOK").select2();
    $("#KODEGRUP").select2();

    $('.modal').on('hidden.bs.modal',function(e){
        $(this).removeData('bs.modal');
    });

    $("#SEGMENGANGGUAN_auto").change(function(){

        var segmen_arr = [];
        $("#SEGMENGANGGUAN_auto option:selected").each(function(i){
            segmen_arr.push($(this).val());
        });
        $('#SEGMENGANGGUAN').val($.map(segmen_arr, $.trim));
    });

    $("#SEGMENGANGGUAN_manual").change(function(){
        $('#SEGMENGANGGUAN').val($(this).val());
    });

    $("#chkAuto").click(function(){
        if( $(this).prop("checked")==true ){
            $("#SEGMENGANGGUAN_manual").hide();
            $("#sgm").show();
        }else{
            $("#SEGMENGANGGUAN_manual").show();
            $("#sgm").hide();
        }
    });
/*
    $("#EKSEKUTOR").focus(function(){
        if( ($("#OP").val() != "") && ($("#CL").val() != "") ){
            strData = "start=" + $("#OP").val() + "&end=" + $("#CL").val();
        }
        else if( ($("#TR").val() != "") && ($("#CL").val() != "") ) {
            strData = "start=" + $("#TR").val() + "&end=" + $("#CL").val();
        }
        else if( ($("#TR").val() != "") && ($("#RC").val() != "") ){
            strData = "start=" + $("#TR").val() + "&end=" + $("#RC").val();
        }
        $.ajax({
            type: "GET",
            url: "modules/crud_logsheet.php?diff=yes",
            dataType: 'json',
            data: strData,//"op=" + $("#OP").val() + "&cl=" + $("#CL").val(),
            success: function(data) {
                $("#LAMA").val(data.a1);
                //$("#LAMAconv").val(data.a2);
            }
        });
    });
*/
    $("#PELANGGANPADAM").change(function(){
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
        $("#KETFGTM").val($("#KODEFGTM").val());
        $("#KFGTM").text($("#KODEFGTM").val());
        /*
        $.ajax({
            type: "GET",
            url: "modules/crud_logsheet.php?rf=fgtm",
            dataType: 'html',
            data: "id=" + $(this).val(),
            success: function(data) {
                $("#KETFGTM").val(data);
            }
        });*/
        //$("#KFGTM").text($("#KODEFGTM").val());
    });

    $("#KODEKELOMPOK").change(function(){
        $("#KKELOMPOK").text($(this).val());
    });
    $("#KODEGRUP").change(function(){
        $("#KGRUP").text($(this).val());
    });

    $("#KODESAIDI").change(function(){
        $("#KSAIDI").text($(this).val());
        $("#KETSAIDI").val($("#KODESAIDI :selected").text());
        /*
        $.ajax({
            type: "GET",
            url: "modules/crud_logsheet.php?ref=saidi",
            dataType: 'html',
            data: "id=" + $(this).val(),
            success: function(data) {
                $("#KETSAIDI").val(data);
            }
        });*/
    });
    $("#tanggal_check input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });

    $("#tanggal_filter input").datepicker().on("changeDate", function () {
        $(this).datepicker("hide");
    });

    $("#TANGGAL").change(function(){
        $(".dttime").val($(this).val());
    })

   // $('.dttime').datetimepicker({
        //format: 'yyyy-mm-dd hh:ii:ss'
    //});

    //Datemask dd/mm/yyyy
    //$(".dttime").inputmask("yyyy-mm-dd hh:mm:ss");
    //Money Euro
    $("[data-mask]").inputmask();

    reloadDatatable();
    $("#TANGGAL_LOGSHEET").change(function(){
        reloadDatatable();
    });


    $("input.typeahead").typeahead({
        onSelect: function(item) {
            $("#PID").val(item.value);
            $.ajax({
                type: "GET",
                url: "modules/crud_logsheet.php?plb=garea",
                dataType: 'json',
                data: "id=" + $("#PID").val(),
                success: function(data) {
                    $("#GIPID").val(data.GIID);
                    $("#GI").val(data.GI.trim());
                    $("#AREAID").val(data.AREAID);
                    $("#AREA").val(data.AREA.trim());
                    $("#ASUHAN").val(data.ASUHAN.trim());
                    $("#WILAYAH").val(data.DCC.trim());
                }
            });
        },
        ajax: {
            url: "modules/crud_logsheet.php?ref=plbsrecgh",
            displayField: "NAME",
            valueField:"PID"
        }
    });

    //var typeaheadSource = [{ id: 1, name: 'John'}, { id: 2, name: 'Alex'}, { id: 3, name: 'Terry'}];

    $('input.typeahead_saidi').typeahead({
        onSelect: function(item) {
            $("#KODESAIDI").val(item.value);
        },
        ajax: {
            url: "modules/crud_logsheet.php?q=saidi",
            displayField: "NAME",
            valueField:"ID"
        }
    });

    $("input.typeahead_gi").typeahead({
        onSelect: function(item) {
            $("#GIPID").val(item.value);
        },
        ajax: {
            url: "modules/crud_logsheet.php?r=gi",
            displayField: "NAME",
            valueField:"ID"
        }
    });

    $("input.typeahead_area").typeahead({
        onSelect: function(item) {
            $("#AREAID").val(item.value);
            $.ajax({
                type: "GET",
                url: "modules/crud_logsheet.php?g=dcc",
                dataType: 'json',
                data: "id=" + $("#AREAID").val(),
                success: function(data) {
                    $("#WILAYAH").val(data.DCC.trim());
                }
            });
        },
        ajax: {
            url: "modules/crud_logsheet.php?a=area",
            displayField: "NAME",
            valueField:"ID"
        }
    });

    $('input.typeahead_asuhan').typeahead({
        ajax: {
            url: "modules/crud_logsheet.php?qs=asuhan",
            displayField: "NAME",
            valueField:"ID"
        }
    });

    var srcArray = ['OCR','UFR','GFR','Tidak ada indikasi','dilepas','dimasukkan','Transmisi'];
    $('input.typeahead_relay').typeahead({
        source: srcArray
    });

    $("#KODESIKLUS").focus(function(){
        var rightNow = new Date();
        var res = rightNow.toISOString().slice(0,10).replace(/-/g,"");
        if($(this).val()==""){
            $(this).val(res);
        }
    });

    $("input.typeahead_segmen1").typeahead({
        onSelect: function(item) {
            $("#PIDSEGMEN1").val(item.value);
            $.ajax({
                type: "GET",
                url: "modules/crud_logsheet.php?pidsegmen1=1",
                dataType: 'json',
                data1: "id=" + $("#PIDSEGMEN1").val(),
                success: function(data1) {
                    $("#JMLSEGMEN1").val(data1);
                    jml = parseInt($("#JMLSEGMEN1").val()) + parseInt($("#JMLSEGMEN2").val()) ;
                    jmlvalid = isNaN(jml) ? 0 : jml;
                    $("#PELANGGANPADAM").val(jmlvalid);
                }
            });
        },
        ajax: {
            url: "modules/crud_logsheet.php?ref=plbsrecgh",
            displayField: "NAME",
            valueField:"PID"
        }
    });

    $("input.typeahead_segmen2").typeahead({
        onSelect: function(item) {
            $("#PIDSEGMEN2").val(item.value);
            $.ajax({
                type: "GET",
                url: "modules/crud_logsheet.php?pidsegmen2=2",
                dataType: 'json',
                data2: "id=" + $("#PIDSEGMEN2").val(),
                success: function(data2) {
                    $("#JMLSEGMEN2").val(data2);
                    jml = parseInt($("#JMLSEGMEN1").val()) + parseInt($("#JMLSEGMEN2").val()) ;
                    jmlvalid = isNaN(jml) ? 0 : jml;
                    $("#PELANGGANPADAM").val(jmlvalid);
                }
            });
        },
        ajax: {
            url: "modules/crud_logsheet.php?ref=plbsrecgh",
            displayField: "NAME",
            valueField:"PID"
        }
    });

    $("input.typeahead_segmen1").change(function(){
        segmen1 = $("input.typeahead_segmen1").val();
        segmen2 = $("input.typeahead_segmen2").val();
        if( (segmen1!="") || (segmen2!="") ){
            $("#SEGMENGANGGUAN").val(segmen1+"-"+segmen2);
        }else{$("#SEGMENGANGGUAN").val(segmen1);}
    });

    $("input.typeahead_segmen2").change(function(){
        segmen1 = $("input.typeahead_segmen1").val();
        segmen2 = $("input.typeahead_segmen2").val();
        if( (segmen1!="") || (segmen2!="") ){
            $("#SEGMENGANGGUAN").val(segmen1+"-"+segmen2);
        }//else{$("#SEGMENGANGGUAN").val(segmen2);}
    });

    $("#KODEKELOMPOK").change(function(){
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax({
            type: "POST",
            url: "modules/list_saidi.php?cat=grup",
            data: dataString,
            cache: false,
            success: function(html){
                $("#KODEGRUP").html(html);
            }
        })
    });

    $("#KODEGRUP").change(function(){
        var id=$(this).val();
        var dataString = 'id='+ id;
        $.ajax({
            type: "POST",
            url: "modules/list_saidi.php?cat=kodesaidi",
            data: dataString,
            cache: false,
            success: function(html){
                $("#KODESAIDI").html(html);
            }
        })
    });

    $('#myModals').on('hide.bs.modal', function (e) {
        $('#SEGMENGANGGUAN_auto').select2("val","");
        $('#penyulang').select2("val","");
    });

    $('#myModals').on('shown.bs.modal', function (e) {
        var id=$("#PID").val();
        var plbs = $("#PLBSRECGH").val();
        var dataString = 'id='+ id;
        var dataStringPlgn = 'id='+ id +"&penyulang=" + plbs;

        if($("#PID").val()!=""){
            $.ajax({
                type: "POST",
                url: "modules/list_saidi.php?cat=segmen",
                data: dataString,
                cache: false,
                success: function(html){
                    $("#SEGMENGANGGUAN_auto").html(html);
                }
            })

            $.ajax({
                type: "POST",
                url: "modules/list_saidi.php?cat=segmen_padam",
                data: dataStringPlgn,
                cache: false,
                success: function(html){
                    $("#penyulang").html(html);
                }
            })
        }
    })

    $("#penyulang").change(function(){
        function sum(input){

            if (toString.call(input) !== "[object Array]")
                return false;

            var total =  0;
            for(var i=0;i<input.length;i++)
            {
                if(isNaN(input[i])){
                    continue;
                }
                total += Number(input[i]);
            }
            return total;
        }

        var plgn_arr = [];
        $("#penyulang option:selected").each(function(i){
            plgn_arr.push($(this).val());
        });

        $("#PELANGGANPADAM").val(sum(plgn_arr));
    });


/*
    var typeaheadSource =   [{
                                PID:"400013", NAME:'Arsan'}, {
                                PID:"400022", NAME:'Anung'},{
                                PID:"400031", NAME:'Armawi'},{
                                PID:"400041", NAME:'Asrul'},{
                                PID:"400042", NAME:'Arjun'
                            }];*/
    /*
    var typeaheadSource = [{
        id: 1, NAME: 'John'}, {
        id: 2, NAME: 'Alex'}, {
        id: 3, NAME: 'Terry'
    }];*/
    //var srcArray = [{"PID":"400013","NAME":"REC KOSTRAD "},{"PID":"400022","NAME":"REC UVRI "},{"PID":"400031","NAME":"INC TRAFO #2 GI SOPPENG "},{"PID":"400041","NAME":"P_CABENGE "},{"PID":"400042","NAME":"REC MAKKIO BAJI "}];
    /*
    $('input.typeahead').typeahead({
        //source: "modules/crud_logsheet.php?ref=plbsrecgh",
        ajax : "modules/crud_logsheet.php?ref=plbsrecgh",
        displayField: 'NAME'
    });*/

});