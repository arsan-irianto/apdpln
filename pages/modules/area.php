<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 12/12/2015
 * Time: 22:52
 */
?>
<script src="modules/area.js" type="text/javascript"></script>
<style>
body {
    padding-right: 0px !important
    }
    .modal-open {
    overflow-y: auto;
    }
    /*td{white-space: nowrap}*/
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
Area
            <small>Master Area</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
            <li class="active">Area</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4"><h3 class="box-title">Data Area</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                    <?php if ($_SESSION['USERNAME'] != "") { ?>
    <a href="#" onClick="showModals()" class="btn btn-default">Add</a>
<?php }?>
</div>
</div>
</div>
<br>
</div><!-- /.box-header -->
<div class="box-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tarea" style="font-size: 0.9em;">
            <thead>
            <tr>
                <th><div align="center">ACTION</div></th>
                <th><div align="center">ID</div></th>
                <th width="200px"><div align="center">Area</div></th>
                <th width="100px"><div align="center">Jml Penyulang</div></th>
                <th width="130px"><div align="center">Panjang Penyulang</div></th>
                <th><div align="center">DCCID</div></th>
                <th><div align="center">DESC</div></th>
            </tr>
            </thead>
            <tbody></tbody>

        </table>
    </div><!-- /.box-body -->
</div>
</div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->