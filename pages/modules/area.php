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
            <li><a href="#"><i class="fa fa-edit"></i> Master</a></li>
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
            <table class="table table-bordered table-striped table-hover" id="tarea" style="font-size: 0.9em;">
                <thead>
                <tr>
                    <th><div align="center">ACTION</div></th>
                    <th><div align="center">ID</div></th>
                    <th width="200px"><div align="center">Area</div></th>
                    <th width="100px"><div align="center">Jml Penyulang</div></th>
                    <th width="130px"><div align="center">Panjang Penyulang</div></th>
                    <th><div align="center">DCCID</div></th>
                    <th width="180px"><div align="center">DESC</div></th>
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
        <div class="modal-dialog" style="width: 40%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Form Area</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="form_area" name="form_area" class="form-horizontal">
                        <input type="hidden" id="type" name="type">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Area ID</label>
                                    <div class="col-sm-4">
                                        <input class="form-control input-sm" value="<?=$AREAID=isset($AREAID)? $AREAID : '';?>" name="AREAID" id="AREAID" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Area Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm" value="<?=$AREA=isset($AREA)? $AREA : '';?>" name="AREA" id="AREA" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Jumlah Penyulang</label>
                                    <div class="col-sm-6">
                                        <input class="form-control input-sm" value="<?=$JUMPENYULANG=isset($JUMPENYULANG)? $JUMPENYULANG : '';?>" name="JUMPENYULANG" id="JUMPENYULANG" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Panjang Penyulang</label>
                                    <div class="col-sm-6">
                                        <input class="form-control input-sm" value="<?=$PANJANGPENYULANG=isset($PANJANGPENYULANG)? $PANJANGPENYULANG : '';?>" name="PANJANGPENYULANG" id="PANJANGPENYULANG" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">DCC</label>
                                    <div class="col-sm-8">
                                        <?php
                                        $queryDCC = "SELECT DCCID,DCC FROM DCC";
                                        $conn->cboFillFromTable("DCCID",$queryDCC,"DCCID","DCC", "--Choose--","form-control input-sm","addnew");
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
                    <button type="button" onClick="submitArea()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

