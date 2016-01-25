<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/01/2016
 * Time: 9:46
 */
?>
<style>
    td{white-space: nowrap}
</style>
<script src="modules/bhp.js" type="text/javascript"></script>
<title> Beban Harian Penyulang</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Laporan
            <small>Beban Harian Penyulang</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i>Rekap Laporan</a></li>
            <li class="active">Beban Harian Penyulang</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data Beban Harian Penyulang</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group input-sm" id="tanggal_filter">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="TANGGAL" id="TANGGAL" class="form-control input-sm" data-date-format="yyyy-mm-dd" required="" value="<?=date("Y-m-d");?>" type="text">
                                    </div><!-- /.input group -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tbhp" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th rowspan="2"><div align="center">DCC</div></th>
                                    <th rowspan="2"><div align="center">Area</div></th>
                                    <th rowspan="2"><div align="center">Gardu Induk</div></th>
                                    <th rowspan="2"><div align="center">Penyulang</div></th>
                                    <th colspan="24"><div align="center">Jam</div></th>
                                </tr>
                                <tr>
                                    <th><div align="center">00</div></th>
                                    <th><div align="center">01</div></th>
                                    <th><div align="center">02</div></th>
                                    <th><div align="center">03</div></th>
                                    <th><div align="center">04</div></th>
                                    <th><div align="center">05</div></th>
                                    <th><div align="center">06</div></th>
                                    <th><div align="center">07</div></th>
                                    <th><div align="center">08</div></th>
                                    <th><div align="center">09</div></th>
                                    <th><div align="center">10</div></th>
                                    <th><div align="center">11</div></th>
                                    <th><div align="center">12</div></th>
                                    <th><div align="center">13</div></th>
                                    <th><div align="center">14</div></th>
                                    <th><div align="center">15</div></th>
                                    <th><div align="center">16</div></th>
                                    <th><div align="center">17</div></th>
                                    <th><div align="center">18</div></th>
                                    <th><div align="center">19</div></th>
                                    <th><div align="center">20</div></th>
                                    <th><div align="center">21</div></th>
                                    <th><div align="center">22</div></th>
                                    <th><div align="center">23</div></th>
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