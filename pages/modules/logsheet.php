<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 10/12/2015
 * Time: 5:54
 */
?>

<script src="modules/logsheet.js" type="text/javascript"></script>
<style>
    body {
        padding-right: 0px !important
    }
    .modal-open {
        overflow-y: auto;
    }
    td{white-space: nowrap}
</style>
<title> LogSheet</title>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Rekap Laporan
        <small>Logsheet</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
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
                    <div class="col-md-4"><h3 class="box-title">Data Logsheet</h3></div>
                    <div class="col-md-8" align="right">
                        <div class="btn-group" id="btnTable">
                            <?php if ($_SESSION['USERNAME'] != "") { ?>
                                <a href="#" onClick="showModals()" class="btn btn-default">Add</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <?php echo combonamabln(1, 12, "cbo_month", "-Month-","form-control input-sm");?>
                    </div>
                    <div class="col-md-2">
                        <?php echo combothn(date("Y")-2, date("Y"), "cbo_year", "-Year-","form-control input-sm");?>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tlogsheet" style="font-size: 0.9em;">
                        <thead>
                        <tr>
                            <th><div align="center">ACTION</div></th>
                            <th><div align="center">TANGGAL</div></th>
                            <th><div align="center">PENYULANG</div></th>
                            <th><div align="center">ASUHAN</div></th>
                            <th><div align="center">AREA</div></th>
                            <th><div align="center">BEBAN PADAM</div></th>
                            <th><div align="center">RELAY</div></th>

                            <th><div align="center">TRIP</div></th>
                            <th><div align="center">EXECUTE</div></th>
                            <th><div align="center">RECLOSE</div></th>
                            <th><div align="center">OPEN</div></th>
                            <th><div align="center">CLOSE</div></th>

                            <th><div align="center">LAMA</div></th>
                            <th><div align="center">KWH</div></th>
                            <th><div align="center">MRF</div></th>
                            <th><div align="center">RC 1</div></th>
                            <th><div align="center">KODE FGTM</div></th>
                            <th><div align="center">KELOMPOK GANGGUAN</div></th>
                            <th><div align="center">KETERANGAN</div></th>
                            <th><div align="center">KOORDINASI</div></th>
                            <th><div align="center">SEGMEN GANGGUAN</div></th>
                            <th><div align="center">TOTAL PELANGGAN</div></th>
                            <th><div align="center">PELANGGAN PADAM</div></th>
                            <th><div align="center">% PELANGGAN PADAM</div></th>
                            <th><div align="center">KODE SAIDI</div></th>
                            <th><div align="center">KETERANGAN KODE PADAM</div></th>
                            <th><div align="center">EKSEKUTOR</div></th>
                            <th><div align="center">SHIFT</div></th>
                        </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

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

<!-- /.modal form Logsheet-->
<div class="modal fade" id="myModals" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Logsheet</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="form_logsheet" name="form_logsheet" class="form-horizontal">
                    <input name="periode" id="periode" value="" type="hidden">
                    <input type="hidden" id="type" name="type">
                    <input name="ID" id="ID" value="" type="hidden">
                    <input name="SC" id="SC" value="1" type="hidden">
                    <input name="MC" id="MC" value="1" type="hidden">
                    <input name="CHK" id="CHK" value="1" type="hidden">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Gardu & Area</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Detail Pemadaman</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Keterangan Gangguan</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">PID</label>
                                        <div class="col-sm-4">
                                            <input class="form-control input-sm" value="" name="PID" id="PID" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">PLBSRECGH</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm typeahead" value="" name="PLBSRECGH" id="PLBSRECGH" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">GIPID</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="GIPID" id="GIPID" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Gardu Induk (GI)</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="GI" id="GI" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Area ID</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="AREAID" id="AREAID" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Area</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="AREA" id="AREA" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Asuhan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="ASUHAN" id="ASUHAN" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Wilayah</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="WILAYAH" id="WILAYAH" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <br>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group input-sm" id="tanggal_check">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input name="TANGGAL" id="TANGGAL" class="form-control input-sm" data-date-format="yyyy-mm-dd" required="" value="" type="text">
                                            </div><!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Trip</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm dttime" value="" name="TR" id="TR" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Execute</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm dttime" value="" name="EX" id="EX" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Close</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm dttime" value="" name="CL" id="CL" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Reclose</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm dttime" value="" name="RC" id="RC" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Open</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm dttime" value="" name="OP" id="OP" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Eksekutor</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="EKSEKUTOR" id="EKSEKUTOR" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Shift</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="SHIFT" id="SHIFT" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Relay</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="RELAY" id="RELAY" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">KWH</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="KWH" id="KWH" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Beban Padam</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="BEBANPADAM" id="BEBANPADAM" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">MRF</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="MRF" id="MRF" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Kode FGTM</label>
                                        <div class="col-sm-8">
                                            <?php
                                            $queryFGTM = "SELECT KODE,KODE FROM GANGGUANFGTM";
                                            $conn->cboFillFromTable("KODEFGTM",$queryFGTM,"KODE","KODE", "--Choose--","form-control input-sm","addnew");
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Keterangan FGTM</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="KETFGTM" id="KETFGTM" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Keterangan</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" rows="3" placeholder="Masukkan Keterangan ..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Kordinasi</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="KORDINASI" id="KORDINASI" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Segmen Gangguan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="SEGMENGANGGUAN" id="SEGMENGANGGUAN" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Kode Saidi</label>
                                        <div class="col-sm-8">
                                            <?php
                                            //echo $KODESAIDI;
                                            $querySAIDI = "SELECT KODE FROM PADAMSAIDI";
                                            $conn->cboFillFromTable("KODESAIDI",$querySAIDI,"KODE","KODE", "--Choose--","form-control input-sm","addnew");
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Keterangan Saidi</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="KETSAIDI" id="KETSAIDI" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Total Pelanggan</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="TOTALPELANGGAN" id="TOTALPELANGGAN" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Pelanggan Padam</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="" name="PELANGGANPADAM" id="PELANGGANPADAM" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="submitLogsheet()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->