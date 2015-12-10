<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 08/11/2015
 * Time: 7:25
 */
?>
<!-- Content Wrapper. Contains page content -->
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
                            <div class="col-md-4" align="right">
                                <div class="btn-group">
                                    <a href="?modules=logsheet&act=addnew" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> add</a>
                                    <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-print"></span> pdf</a>
                                    <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list"></span> excel</a>
                                </div>
                            </div>
                            <div class="col-md-2" align="right">
                                <select class="form-control input-sm">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select></div>
                        </div>


                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed table-hover" id="fgtm" style="width: 100%;font-size: 0.9em;">
                                <tr>
                                    <th rowspan="2"><div align="center">CHECK</div></th>
                                    <th rowspan="2"><div align="center">TANGGAL</div></th>
                                    <th rowspan="2"><div align="center">PENYULANG</div></th>
                                    <th rowspan="2"><div align="center">ASUHAN</div></th>
                                    <th rowspan="2"><div align="center">AREA</div></th>
                                    <th rowspan="2"><div align="center">BEBAN NOMINAL PENYULANG ASUHAN SEBELUM TRIP</div></th>
                                    <th rowspan="2"><div align="center">BEBAN PADAM</div></th>
                                    <th rowspan="2"><div align="center">RELAY</div></th>
                                    <th colspan="5" rowspan="2"><div align="center">PENYULANG/ LBS/ REC/ GH</div></th>
                                    <th rowspan="2"><div align="center">LAMA</div></th>
                                    <th rowspan="2"><div align="center">KWH</div></th>
                                    <th rowspan="2"><div align="center">MRF</div></th>
                                    <th rowspan="2"><div align="center">RC 1</div></th>
                                    <th rowspan="2"><div align="center">KODE FGTM</div></th>
                                    <th rowspan="2"><div align="center">KELOMPOK GANGGUAN</div></th>
                                    <th rowspan="2"><div align="center">KETERANGAN</div></th>
                                    <th rowspan="2"><div align="center">KOORDINASI</div></th>
                                    <th rowspan="2"><div align="center">SEGMEN GANGGUAN</div></th>
                                    <th rowspan="2"><div align="center">TOTAL PELANGGAN</div></th>
                                    <th rowspan="2"><div align="center">PELANGGAN PADAM</div></th>
                                    <th rowspan="2"><div align="center">% PELANGGAN PADAM</div></th>
                                    <th rowspan="2"><div align="center">KODE SAIDI</div></th>
                                    <th rowspan="2"><div align="center">KETERANGAN KODE PADAM</div></th>
                                    <th rowspan="2"><div align="center">EKSEKUTOR</div></th>
                                    <tH rowspan="2"><div align="center">SHIFT</div></th>
                                    <th rowspan="2"><div align="center">KINERJA</div></th>
                                    <th rowspan="2"><div align="center">SCADA</div></th>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <?php
                                    for($n=1; $n <=31; $n++){
                                        echo "<th><div align='center'>$n</div></th>";
                                    }
                                    ?>
                                </tr>
                                <?php

                                $p      = new Paging;
                                $batas  = 10;
                                $posisi = $p->cariPosisi($batas);
                                $jmldata= $conn->numRows("Sheet2$");
                                $jmlcol = $conn->numCols("Sheet2$");
                                $query  = $conn->queryPaging("[CHECK]", "Sheet2$", $posisi, $batas);
                                $query->execute();
                                while ($row = $query->fetch()) {
                                    echo "<tr>";
                                    for($i=0; $i<=$jmlcol; $i++) {
                                        echo "<td nowrap>" . $row[$i] . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                unset($conn); unset($query);

                                ?>
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php

                                $link = $_SERVER['PHP_SELF']."?modules=".$_GET['modules'];
                                $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman, $link);
                                echo $linkHalaman;

                                ?>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
