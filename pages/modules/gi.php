<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 12/12/2015
 * Time: 23:01
 */
?>
<script src="modules/gi.js" type="text/javascript"></script>
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
            GI
            <small>Master GI</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
            <li class="active">GI</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data GI</h3></div>
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
                            <table class="table table-bordered table-striped table-hover" id="tgi" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th width="30px"><div align="center">ACTION</div></th>
                                    <th width="30px"><div align="center">GIID</div></th>
                                    <th width="350px"><div align="center">GI</div></th>
                                    <th width="30"><div align="center">DCCID</div></th>
                                    <th width="200"><div align="center">DESC</div></th>
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