<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 05/12/2015
 * Time: 9:54
 */
//session_start();
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
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Form Logsheet</h4>
                    </div>
                    <div class="modal-body">

                    <form role="form" id="form_logsheet" name="form_logsheet">
                    <input name="periode" id="periode" value="" type="hidden">
                    <input type="hidden" id="type" name="type">
                    <input name="ID" id="ID" value="" type="hidden">
                    <input name="SC" id="SC" value="1" type="hidden">
                    <input name="MC" id="MC" value="1" type="hidden">
                    <input name="CHK" id="CHK" value="1" type="hidden">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group input-sm" id="tanggal_check">
                                    <label>Tanggal Check</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="TANGGAL" id="TANGGAL" class="form-control input-sm" data-date-format="yyyy-mm-dd" required="" value="" type="text">
                                    </div><!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-sm">
                                    <label>LBSREC</label>
                                    <?php
                                    //$queryPenyulang = "SELECT PLBSREC FROM LBSREC";
                                    //$conn->cboFillFromTable("PLBSREC",$queryPenyulang,"PLBSREC","PLBSREC", "--Choose--","form-control input-sm","addnew");
                                    ?>
                                    <input name="PLBSREC" class="form-control input-sm" id="PLBSREC" value="" type="text">
                                    <input name="ASUHAN" id="ASUHAN" value="" type="hidden">
                                    <input name="AREA" id="AREA" value="" type="hidden">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>Beban Padam</label>
                                    <select class="form-control input-sm" name="GIPID" id="GIPID">
                                        <option value="0">0</option>
                                        <option value="12">123</option>
                                    </select>
                                    <input name="BEBANPADAM" id="BEBANPADAM" value="0" type="hidden">
                                    <input name="OE" id="OE" value="1" type="hidden">
                                    <input name="CE" id="CE" value="" type="hidden">
                                    <input name="EOT" id="EOT" value="" type="hidden">
                                    <input name="ECT" id="ECT" value="" type="hidden">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>OO Name</label>
                                    <input class="form-control input-sm" name="OO" id="OO" placeholder="OO Name" required="" value="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>CO Name</label>
                                <input class="form-control input-sm" name="CO" id="CO" placeholder="CO Name" required="" value="" type="text">
                                <input name="OT" id="OT" value="" type="hidden">
                                <input name="CT" id="CT" value="" type="hidden">
                                <input name="AE" id="AE" value="0" type="hidden">
                                <input name="DE" id="DE" value="0" type="hidden">
                                <input name="AT" id="AT" value="" type="hidden">
                                <input name="DT" id="DT" value="" type="hidden">
                                <input name="AR" id="AR" value="" type="hidden">
                                <input name="DR" id="DR" value="" type="hidden">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Trip</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control input-sm dttime" value="" name="TR" id="TR" data-date-format="yyyy-mm-dd hh:ii:ss" placeholder="00:00:00" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Execute</label>
                                    <input class="form-control input-sm dttime" value="" name="EX" id="EX" placeholder="00:00:00" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>Reclose</label>
                                    <input class="form-control input-sm dttime" value="" name="RC" id="RC" placeholder="00:00:00" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>Open</label>
                                    <input class="form-control input-sm dttime" value="" name="OP" id="OP" placeholder="00:00:00" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>Close</label>
                                    <input class="form-control input-sm dttime" name="CL" id="CL" placeholder="00:00:00" type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Relay</label>
                                    <input class="form-control input-sm" value="" name="RELAY" id="RELAY" placeholder="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Lama</label>
                                    <input class="form-control input-sm" name="LAMA" id="LAMA" value="0" readonly="" type="hidden">
                                    <input class="form-control input-sm" name="LAMAconv" id="LAMAconv" value="0" readonly="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>KWH</label>
                                    <input class="form-control input-sm" value="" name="KWH" id="KWH" placeholder="0.000" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>M/R/F</label>
                                    <input class="form-control input-sm" name="MRF" id="MRF" type="text">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-sm">
                                    <label>RC-1</label>
                                    <input class="form-control input-sm"  name="JEDARC1" id="JEDARC1" placeholder="0" type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Kelompok Gangguan</label>
                                    <?php
                                    $queryFGTM = "SELECT KODE,KETFGTM FROM GANGGUANFGTM";
                                    $conn->cboFillFromTable("KODEFGTM",$queryFGTM,"KODE","KETFGTM", "--Choose--","form-control input-sm","addnew");
                                    ?>
                                    <input name="KETFGTM" id="KETFGTM" type="hidden" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Keterangan</label>
                                    <input class="form-control input-sm" name="KETERANGAN" id="KETERANGAN" value="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Koordinasi</label>
                                    <input class="form-control input-sm" name="KORDINASI" id="KORDINASI" value="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Segmen Gangguan</label>
                                    <input class="form-control input-sm" name="SEGMENGANGGUAN" id="SEGMENGANGGUAN" value="" type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Total Pelanggan</label>
                                    <input class="form-control input-sm" placeholder="0" value="0" name="TOTALPELANGGAN" id="TOTALPELANGGAN" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Pelanggan Padam</label>
                                    <input class="form-control input-sm" value="0" name="PELANGGANPADAM" id="PELANGGANPADAM" placeholder="0" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>% Pelanggan Padam</label>
                                    <input class="form-control input-sm" value="0" name="PERSENPELANGGANPADAM" id="PERSENPELANGGANPADAM" readonly="" type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label>Keterangan Padam</label>
                                    <?php
                                    //echo $KODESAIDI;
                                    $querySAIDI = "SELECT KODE,KETSAIDI FROM PADAMSAIDI";
                                    $conn->cboFillFromTable("KODESAIDI",$querySAIDI,"KODE","KETSAIDI", "--Choose--","form-control input-sm","addnew");
                                    ?>
                                    <input name="KETSAIDI" id="KETSAIDI" value="" type="hidden">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Eksekutor</label>
                                    <input class="form-control input-sm" value="" name="EKSEKUTOR" id="EKSEKUTOR" type="text">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group input-sm">
                                    <label>Shift</label>
                                    <input class="form-control input-sm" value="" name="SHIFT" id="SHIFT" type="text">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" onClick="submitLogsheet()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        </script>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->