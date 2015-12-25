<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/12/2015
 * Time: 15:08
 */

?>

<script src="modules/transmisi.js" type="text/javascript"></script>
<style>
td{white-space: nowrap}
    /*
    table.dataTable tr.odd { background-color: #FFBE5E; }
    table.dataTable tr.even { background-color: white; }
    */
</style>
<title> Transmisi</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
Rekap Laporan
<small>Transmisi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i> Rekap Laporan</a></li>
            <li class="active">Transmisi</li>
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
                    <div class="col-md-4"><h3 class="box-title">Data Transmisi</h3></div>
                    <div class="col-md-8" align="right">
                        <div class="btn-group" id="btnTable">
                            <a href="#" id="btnPdf" target="_blank" class="btn btn-default">Pdf</a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-2">
                        <?php echo combonamabln(1, 12, "cbo_month", "-Month-","form-control input-sm");?>
</div>
<div class="col-md-2">
    <?php echo combothn(date("Y")-2, date("Y"), "cbo_year", "-Year-","form-control input-sm");?>
</div>
<div class="col-md-2">
    <?php
    $items = array("all"=>"All", "utara"=>"Utara", "selatan"=>"Selatan");
    echo cboFillFromArray("cbo_wilayah", $items, "--Choose--", "form-control input-sm");
    ?>
</div>
</div>

</div><!-- /.box-header -->
<div class="box-body">
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="ttransmisi" style="width: 100%;font-size: 0.9em;">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Feeder</th>
                    <th><div align="center">Load</div></th>
                    <th colspan="2"><div align="center">Waktu</div></th>
                    <th rowspan="2" >Lama(Menit)</th>
                    <th rowspan="2" class="sum">Daya (MW)</th>
                    <th rowspan="2" class="sum">MWH</th>
                </tr>
                <tr>
                    <th>(Ampere)</th>
                    <th>Lepas</th>
                    <th>Masuk</th>
                </tr>
                </thead>
                <tfoot>
                <th colspan="6">Total</th>
                <th></th>
                <th></th>
                </tfoot>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box-body -->
</div>
</div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

