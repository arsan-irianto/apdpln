<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 12/12/2015
 * Time: 23:15
 */
?>
<script src="modules/plbsrecgh.js" type="text/javascript"></script>
<style>
    body {
        padding-right: 0px !important
    }
    .modal-open {
        overflow-y: auto;
    }
    td{white-space: nowrap}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PLBSRECGH
            <small>Master PLBSRECGH</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
            <li class="active">PLBSRECGH</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data PLBSRECGH</h3></div>
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
                            <table class="table table-bordered table-striped table-hover" id="tplbsrecgh" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th><div align="center">ACTION</div></th>
                                    <th><div align="center">PID</div></th>
                                    <th><div align="center">STPOINTNAME</div></th>
                                    <th><div align="center">ANALOGID</div></th>
                                    <th><div align="center">ANPOINTNAME</div></th>
                                    <th><div align="center">RTUID</div></th>
                                    <th><div align="center">RTUNAME</div></th>
                                    <th><div align="center">NAME</div></th>
                                    <th><div align="center">NORMALLYCLOSED</div></th>
                                    <th><div align="center">ASUHANID1</div></th>
                                    <th><div align="center">ASUHANID2</div></th>
                                    <th><div align="center">GIID</div></th>
                                    <th><div align="center">AREAID</div></th>
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