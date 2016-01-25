<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 23/01/2016
 * Time: 21:57
 */
session_start();
include_once("../../config/connect.php");
include_once("../../library/functions.php");
?>
<html>
    <link href="../../plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../font-awesome/css/fonts.googleapis.css" rel="stylesheet" type="text/css" />
    <link href="../../font-awesome/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../../dist/js/common.js" type="text/javascript"></script>
    <script src="../modules/charts_details.js" type="text/javascript"></script>
    <style>
        body {
            padding-right: 0px !important
        }
        .modal-open {
            overflow-y: auto;
        }
        td{white-space: nowrap}
        .datepicker{z-index:1200 !important;}
    </style>


    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <form id="form1" name="form1" method="get" enctype="multipart/form-data" action="../modules/act_chart_details.php">
            <input type="hidden" name="modules" id="modules" value="<?=$_GET['modules'];?>" >
            <input type="hidden" name="areaid" id="areaid" value="<?=$areaid=isset($_GET['areaid'])? $_GET['areaid'] : '';?>" >
            <input type="hidden" name="giid" id="giid" value="<?=$giid=isset($_GET['giid'])? $_GET['giid'] : '';?>" >
            <input type="hidden" name="bulan" id="bulan" value="<?=$bulan=isset($_GET['bulan'])? $_GET['bulan'] : '';?>" >
            <input type="hidden" name="tahun" id="tahun" value="<?=$tahun=isset($_GET['tahun'])? $_GET['tahun'] : '';?>" >
            <input type="hidden" name="kodefgtm" id="kodefgtm" value="<?=$kodefgtm=isset($_GET['kodefgtm'])? $_GET['kodefgtm'] : '';?>" >
            <input type="hidden" name="lama" id="lama" value="<?=$lama=isset($_GET['lama'])? $_GET['lama'] : '';?>" >
            <input type="hidden" name="relay" id="relay" value="<?=$relay=isset($_GET['relay'])? $_GET['relay'] : '';?>" >
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-4"><h3 class="box-title">Detail Grafik</h3></div>
                                <div class="col-md-8" align="right">
                                    <div class="btn-group" id="btnTable">
                                        <a href="#" onclick="javascript:document.forms['form1'].submit();" class="btn btn-default">Excel</a>
                                        <a href="#" onclick="window.close();" class="btn btn-default">Close</a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div><!-- /.box-header -->
                        <div class="box-body" id="gridData">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tchartsdetails" style="font-size: 0.9em;">
                                    <thead>
                                    <tr>
                                        <th><div align="center">TANGGAL</div></th>
                                        <th><div align="center">AREA</div></th>
                                        <th><div align="center">GI</div></th>
                                        <th><div align="center">ASUHAN</div></th>
                                        <th><div align="center">PENYULANG</div></th>
                                        <th><div align="center">TRIP</div></th>
                                        <th><div align="center">EXECUTE</div></th>
                                        <th><div align="center">RECLOSE</div></th>
                                        <th><div align="center">OPEN</div></th>
                                        <th><div align="center">CLOSE</div></th>
                                        <th><div align="center">LAMA</div></th>
                                        <th><div align="center">PELANGGAN PADAM</div></th>
                                        <th><div align="center">SEGMEN GANGGUAN</div></th>
                                        <th><div align="center">KODE PADAM</div></th>
                                        <th><div align="center">GANGGUAN</div></th>
                                        <th><div align="center">KELOMPOK GANGGUAN</div></th>
                                        <th><div align="center">KETERANGAN GANGGUAN</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                        </div>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </form>

    </section><!-- /.content -->

<?php
include_once("../footer.php");
?>
</html>