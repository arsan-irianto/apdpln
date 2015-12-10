<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 14/11/2015
 * Time: 16:36
 */

?>
<script src="modules/table_logsheet.js" type="text/javascript"></script>
<style>
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
                                    <a href="?modules=logsheet&act=addnew" class="btn btn-default">Add</a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <?php
                                $queryPeriod = "select DISTINCT tgl_name,bulan from
                                                    (Select DateName( Month, TANGGAL ) + DateName( Year, TANGGAL ) as tgl_name,
                                                        TANGGAL,
                                                        MONTH(TANGGAL) as bulan,
                                                        YEAR(TANGGAL) as tahun
                                                      from LOGSHEET) a
                                                      where YEAR(TANGGAL)='2015'
                                                      order by bulan DESC";
                                $conn->cboFillFromTable("sPeriod",$queryPeriod,"tgl_name","tgl_name",
                                    $default="-- Periode --","form-control input-sm","addnew");
                                ?>
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

        <div class="modal fade" id="test" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="<?="modules/action_logsheet.php";?>" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="modules" value="logsheet">
                        <input type="hidden" name="act" value="delete">
                        <input type="hidden" id="delid" name="id">
                        <p>Yakin akan menghapus data ? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i>Ya</button>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i>Tidak</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->