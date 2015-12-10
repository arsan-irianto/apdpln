<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 08/11/2015
 * Time: 7:25
 */
?>
<!-- Content Wrapper. Contains page content -->
<link href="../../plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<script src="../../plugins/datatables/jQuery-2.1.4/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="../../plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="../../plugins/datatables/pdfmake/pdfmake.min.js" type="text/javascript"></script>
<script src="../../plugins/datatables/pdfmake/vfs_fonts.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#fgtm').DataTable( {
            ajax: "json_view_logsheet.php",
            pagingType: "full_numbers",
            dom: 'Bfrtip',
            scrollX: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            columnDefs: [ {
                targets: -1,
                visible: false
            } ]
        } );
    } );
</script>
<style>
    td{white-space: nowrap}
</style>
<title>LogSheet</title>
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
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6"><h3 class="box-title">Data Logsheet</h3></div>
                            <div class="col-md-6" id="#btnTools"></div>
                        </div>


                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed table-hover" id="fgtm" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th >CHECK</th>
                                    <th >TANGGAL</th>
                                    <th >PENYULANG</th>
                                    <th >ASUHAN</th>
                                    <th >AREA</th>
                                    <th >BEBAN NOMINAL PENYULANG ASUHAN SEBELUM TRIP</th>
                                    <th >BEBAN PADAM</th>
                                    <th >RELAY</th>
                                    <th >TRIP</th>
                                    <th >EXECUTE</th>
                                    <th >RECLOSE</th>
                                    <th >OPEN</th>
                                    <th >CLOSE</th>
                                    <th >LAMA</th>
                                    <th >KWH</th>
                                    <th >MRF</th>
                                    <th >RC 1</th>
                                    <th >KODE FGTM</th>
                                    <th >KELOMPOK GANGGUAN</th>
                                    <th >KETERANGAN</th>
                                    <th >KOORDINASI</th>
                                    <th >SEGMEN GANGGUAN</th>
                                    <th >TOTAL PELANGGAN</th>
                                    <th >PELANGGAN PADAM</th>
                                    <th >% PELANGGAN PADAM</th>
                                    <th >KODE SAIDI</th>
                                    <th >KETERANGAN KODE PADAM</th>
                                    <th >EKSEKUTOR</th>
                                    <th >SHIFT</th>
                                    <th >KINERJA</th>
                                    <th >SCADA</th>
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
