<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 13/11/2015
 * Time: 22:16
 * jquery.dataTables.min.css
 * jquery-1.11.3.min.js
 * jquery.dataTables.min.js
 */
?>
<link href="plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<script src="plugins/datatables/jQuery-2.1.4/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/ColReorder-1.3.0/js/ColReorderWithResize.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            "ajax": "tesclass.php",
            "sDom": "Rlfrtip"
        } );
    } );
</script>

<table id="example" class="table table-bordered table-condensed table-hover" style="width: 100%;font-size: 0.9em;">
    <thead>
    <tr>
        <th>Kode Unit</th>
        <th>Nama Unit</th>
        <th>Jumlah Penyulang</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Kode Unit</th>
        <th>Nama Unit</th>
        <th>Jumlah Penyulang</th>
    </tr>
    </tfoot>
</table>
