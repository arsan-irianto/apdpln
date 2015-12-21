<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 12/12/2015
 * Time: 23:07
 */
?>
<script src="modules/asuhan.js" type="text/javascript"></script>
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
            Asuhan
            <small>Master Asuhan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-edit"></i> Master</a></li>
            <li class="active">Asuhan</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data Asuhan</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                    <?php if ($TYPE == 1) { ?>
                                        <a href="#" onClick="showModals()" class="btn btn-default">Add</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tasuhan" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th><div align="center">ACTION</div></th>
                                    <th><div align="center">ID</div></th>
                                    <th width="200px"><div align="center">SCADA Name</div></th>
                                    <th width="200px"><div align="center">Name</div></th>
                                    <th width="80px"><div align="center">Area ID</div></th>
                                    <th width="50px"><div align="center">GIID</div></th>
                                    <th width="50px"><div align="center">Type</div></th>
                                    <th><div align="center">Panjang Penyulang</div></th>
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

<div class="modal fade" id="delModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="form_delete" id="form_delete" autocomplete="off">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="act" id="act" value="delete">
                    <input type="hidden" id="delid" name="delid">
                    <p>Yakin akan menghapus data ? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="submitDelete()" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-trash-o"></i> Ya</button>
                    <button type="button" id="closeDel" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> Tidak</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModals" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Asuhan</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="form_asuhan" name="form_asuhan" class="form-horizontal">
                    <input type="hidden" id="type" name="type">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">ASUHAN ID</label>
                                <div class="col-sm-4">
                                    <input class="form-control input-sm" value="<?=$ASUHANID=isset($ASUHANID)? $ASUHANID : '';?>" name="ASUHANID" id="ASUHANID" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">SCADA Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-sm" value="<?=$SCADANAME=isset($SCADANAME)? $SCADANAME : '';?>" name="SCADANAME" id="SCADANAME" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-sm" value="<?=$NAME=isset($NAME)? $NAME : '';?>" name="NAME" id="NAME" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Area</label>
                                <div class="col-sm-8">
                                    <?php
                                    $queryAREA = "SELECT AREAID,AREA FROM AREA";
                                    $conn->cboFillFromTable("AREAID",$queryAREA,"AREAID","AREA", "--Choose--","form-control input-sm","addnew");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">GI</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-sm typeahead" value="<?=$GI=isset($GI)? $GI : '';?>" name="GI" id="GI" type="text">
                                    <input class="form-control input-sm" value="<?=$GIID=isset($GIID)? $GIID : '';?>" name="GIID" id="GIID" type="hidden">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Panjang Penyulang</label>
                                <div class="col-sm-4">
                                    <input class="form-control input-sm" value="<?=$PANJANGPENYULANG=isset($PANJANGPENYULANG)? $PANJANGPENYULANG : 0;?>" name="PANJANGPENYULANG" id="PANJANGPENYULANG" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Type</label>
                                <div class="col-sm-4">
                                    <?php
                                        $types = array(0=>"GARDU INDUK", 1=>"PENYULANG");
                                        echo cboFillFromArray("TYPE", $types, "--Choose--", "form-control input-sm");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-sm" value="<?=$DESC=isset($DESC)? $DESC : '';?>" name="DESC" id="DESC" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="submitAsuhan()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>