<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 17/12/2015
 * Time: 9:52
 */
?>

<script src="modules/pkb.js" type="text/javascript"></script>
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
            Rekap Laporan
            <small>Parameter Hitung Saidi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i> Rekap Laporan</a></li>
            <li class="active">Parameter Hitung Saidi</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data Parameter Hitung Saidi</h3></div>
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
                            <table class="table table-bordered table-striped table-hover" id="tpkb" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th width="30px"><div align="center">Action</div></th>
                                    <th width="50px"><div align="center">Bulan</div></th>
                                    <th width="50px"><div align="center">Tahun</div></th>
                                    <th width="150px"><div align="center">Total Pelanggan</div></th>
                                    <th width="50px"><div align="center">DCCID</div></th>
                                    <th width="50px"><div align="center">AREAID</div></th>
                                    <th width="180"><div align="center">KWH Rata-rata per hari </div></th>
                                    <th width="180"><div align="center">KWH Rata-rata per jam </div></th>
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
                <h4 class="modal-title" id="myModalLabel">Form Pelanggan KWH Bulanan</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="form_pkb" name="form_pkb" class="form-horizontal">
                    <input type="hidden" id="type" name="type">
                    <input type="hidden" id="PKEY" name="PKEY" value="<?=$PKEY=isset($PKEY)? $PKEY : '';?>">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Bulan</label>
                                <div class="col-sm-8">
                                    <?php echo combonamabln(1, 12, "BULAN", "-Month-","form-control input-sm");?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Tahun</label>
                                <div class="col-sm-8">
                                    <?php echo combothn(date("Y")-2, date("Y"), "TAHUN", "-Year-","form-control input-sm");?>
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
                                <label class="col-sm-4 control-label">AREA</label>
                                <div class="col-sm-8">
                                    <?php
                                    $queryAREA = "SELECT AREAID, AREA FROM AREA";
                                    $conn->cboFillFromTable("AREAID",$queryAREA,"AREAID","AREA", "--Choose--","form-control input-sm","addnew");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">Total Pelanggan</label>
                                <div class="col-sm-4">
                                    <input class="form-control input-sm" value="<?=$TOTALPELANGGAN=isset($TOTALPELANGGAN)? $TOTALPELANGGAN : 0;?>" name="TOTALPELANGGAN" id="TOTALPELANGGAN" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">KWH Rata-rata per hari</label>
                                <div class="col-sm-4">
                                    <input class="form-control input-sm" value="<?=$KWHRATARATAHARIANPELANGGAN=isset($KWHRATARATAHARIANPELANGGAN)? $KWHRATARATAHARIANPELANGGAN : 0;?>" name="KWHRATARATAHARIANPELANGGAN" id="KWHRATARATAHARIANPELANGGAN" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group input-sm">
                                <label class="col-sm-4 control-label">KWH Rata-rata per jam</label>
                                <div class="col-sm-4">
                                    <input class="form-control input-sm" value="<?=$KWHRATARATAJAMPELANGGAN=isset($KWHRATARATAJAMPELANGGAN)? $KWHRATARATAJAMPELANGGAN : 0;?>" name="KWHRATARATAJAMPELANGGAN" id="KWHRATARATAJAMPELANGGAN" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="submitPkb()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>