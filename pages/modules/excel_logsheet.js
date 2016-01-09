/**
 * Created by Arsan Irianto on 08/01/2016.
 */


function getData(status){
    if(status==false){
        //waitingDialog.show();
        $.ajax({
            url 	: '../modules/act_view_logsheet.php',
            cache	: false,
            data	: { modules:document.form1.modules.value},
            success : function(output){
                //waitingDialog.hide();
                $('#gridData').html(output);
            }
        });
    }
    else{
        waitingDialog.show();
        $.ajax({
            url		:'../modules/act_view_logsheet.php',
            cache	: false,
            data	: { modules:document.form1.modules.value,
                month:document.form1.cbo_month.value,
                year:document.form1.cbo_year.value  },
            success	: function(output){
                waitingDialog.hide();
                $('#gridData').html(output);
            }
        });
    }
}

$(function () {
    //reloadDatatable();
    getData(false);
    $("#cbo_month").change(function(){
        if($(this).val()!= ''){
            getData(true);
            //reloadDatatable();
        }
        else {alert("Choose Month & Year Option");}
    });

    $('#cbo_month').change(function(){
        getData(true);
    });
});
