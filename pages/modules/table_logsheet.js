/**
 * Created by Arsan Irianto on 25/11/2015.
 */
function showModal(){
    $(".alertdel").click(function(){
        var id = $(this).attr("id");
        $('#test').modal('show');
        $('#delid').val(id);
    });
}
$(function () {
    $('#tlogsheet').DataTable({
        processing: true,
        serverSide: true,
        ajax: "modules/json_logsheet.php"
    });
});
