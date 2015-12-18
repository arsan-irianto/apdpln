<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 14/11/2015
 * Time: 21:37
 */
?>
<script src="modules/table_fgtm.js" type="text/javascript"></script>
<style>
    td{white-space: nowrap}
    /*
    table.dataTable tr.odd { background-color: #FFBE5E; }
    table.dataTable tr.even { background-color: white; }
    */
</style>
<title> Data FGTM</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Laporan
            <small>FGTM</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Rekap Laporan</a></li>
            <li class="active">FGTM</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data FGTM</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                    <a href="#" id="btnPdf" target="_blank" class="btn btn-default">Pdf</a>
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
                            <table class="table table-bordered table-striped table-hover" id="tfgtm" style="width: 100%;font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th rowspan="3">No</th>
                                    <th rowspan="3">Unit</th>
                                    <th>Jumlah</th>
                                    <th>Panjang</th>
                                    <th colspan="13"><div align="center">Gangguan (Kali)</div></th>
                                    <th>Per</th>
                                    <th>Per</th>
                                </tr>
                                <tr>
                                    <th>Penyulang</th>
                                    <th>Penyulang</th>
                                    <th colspan="5"><div align="center">Penyebab Internal</div></th>
                                    <th colspan="5"><div align="center">Penyebab Eksternal</div></th>
                                    <th colspan="3"><div align="center">Jumlah Gangguan</div></th>
                                    <th>100 kms</th>
                                    <th>100 kms</th>
                                </tr>
                                <tr>
                                    <th>(bh)</th>
                                    <th>(kms)</th>
                                    <th>I-1</th>
                                    <th>I-2</th>
                                    <th>I-3</th>
                                    <th>I-4</th>
                                    <th>Jumlah I</th>
                                    <th>E-1</th>
                                    <th>E-2</th>
                                    <th>E-3</th>
                                    <th>E-4</th>
                                    <th>Jumlah E</th>
                                    <th>>5"</th>
                                    <th><5"</th>
                                    <th>Total</th>
                                    <th>(Gangguan>5")</th>
                                    <th>(Gangguan Total)</th>
                                </tr>
                                <tr>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9=5+6+7+8</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14=10+11+12+13</th>
                                    <th>15</th>
                                    <th>16=9+14</th>
                                    <th>17=15+16</th>
                                    <th>18=16/4</th>
                                    <th>19=17/4</th>
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

