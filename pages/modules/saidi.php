<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 14/12/2015
 * Time: 6:17
 */
//session_start();
?>
<script src="modules/saidi.js" type="text/javascript"></script>
<style>
    td{white-space: nowrap}
</style>
<title> Data SAIDI</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Laporan
            <small>Saidi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i> Rekap Laporan</a></li>
            <li class="active">Saidi</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data SAIDI</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                       <a href="#" id="btnPdf" target="_blank" class="btn btn-default">Pdf</a>
                                   </div>
                               </div>
                           </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <?php
                                $queryDCC = "SELECT DCCID,DCC FROM DCC";
                                $conn->cboFillFromTable("DCCID",$queryDCC,"DCCID","DCC", "-Wilayah-","form-control input-sm","addnew");
                                ?>
                            </div>
                            <div class="col-md-2">
                                <select name="AREAID" id="AREAID" class="form-control input-sm" required=""><option value="" selected="">-Area-</select>
                            </div>
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
                            <table class="table table-bordered table-striped table-hover" id="tsaidi" style="width: 100%;font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th><div align="center">Kode</div></th>
                                    <th><div align="center">Penyebab Pemadamam</div></th>
                                    <th><div align="center">Jumlah Pelanggan Padam</div></th>
                                    <th><div align="center">Menit x Pelanggan Padam</div></th>
                                    <th><div align="center">Jam x Pelanggan Padam</div></th>
                                    <th><div align="center">Lama Menit Padam Rata-Rata (SAIDI)</div></th>
                                    <th><div align="center">Lama Jam Padam Rata-Rata (SAIDI)</div></th>
                                    <th><div align="center">Frekuensi Padam Rata-Rata (SAIFI)</div></th>
                                    <th><div align="center">Jumlah Gangguan/Kali</div></th>
                                    <th><div align="center">Lama Padam(Jam)</div></th>
                                    <th><div align="center">Beban Padam (KWH)</div></th>
                                </tr>
                                <tr>
                                    <th><div align="center">(a)</div></th>
                                    <th><div align="center">(b)</div></th>
                                    <th><div align="center">(c)</div></th>
                                    <th><div align="center">(d)</div></th>
                                    <th><div align="center">(e)</div></th>
                                    <th><div align="center">(f)</div></th>
                                    <th><div align="center">(g)</div></th>
                                    <th><div align="center">(h)</div></th>
                                    <th><div align="center">(i)</div></th>
                                    <th><div align="center">(j)</div></th>
                                    <th><div align="center">(k)</div></th>
                                </tr>
                                </thead>
                            </table>
                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->