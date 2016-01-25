/**
 * Created by Arsan Irianto on 23/01/2016.
 */

$(function () {
    waitingDialog.show();
    var strParams = "modules="+$("#modules").val()+"&areaid="+$("#areaid").val()+"&giid="+$("#giid").val()
                    +"&bulan="+$("#bulan").val()+"&tahun="+$("#tahun").val()
                    +"&kodefgtm="+$("#kodefgtm").val()+"&lama="+$("#lama").val()
                    +"&relay="+$("#relay").val();
    var dTable = $('#tchartsdetails').DataTable({
        ajax: "../modules/json_charts_details.php?" + strParams,
        //ajax: "../modules/charts_details.json",
        deferRender: true,
        pagingType: "full_numbers",
        scrollX: true,
        language: {
            zeroRecords: "Records Not Found"
        }
    });
    waitingDialog.hide();
});

