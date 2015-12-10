<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 07/11/2015
 * Time: 20:40
 */

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Laporan
            <small>Saidi</small>
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
                            <div class="col-md-8"><h3 class="box-title">Data SAIDI</h3></div>
                            <div class="col-md-2" align="right">
                                <div class="btn-group">
                                    <a href="reports/rpt_generator.php?name=saidi&type=pdf" target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-print"></span> pdf</a>
                                    <a href="reports/rpt_generator.php?name=saidi&type=xls" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list"></span> excel</a>
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
                                    <th><div align="center">No.Kode</div></th>
                                    <th><div align="center">PENYEBAB  PEMADAMAN</div></th>
                                    <th><div align="center">JUMLAH PELANGGAN PADAM</div></th>
                                    <th><div align="center">MENIT  X PELANGGAN PADAM</div></th>
                                    <th><div align="center">JAM  X PELANGGAN PADAM</div></th>
                                    <th><div align="center">LAMA MENIT PADAM RATA-RATA (SAIDI)</div></th>
                                    <th><div align="center">LAMA JAM PADAM RATA-RATA (SAIDI)</div></th>
                                    <th><div align="center">FREKUENSI PADAM RATA-RATA (SAIFI)</div></th>
                                    <th><div align="center">JUMLAH GANGGUAN (KALI)</div></th>
                                    <th><div align="center">LAMA PADAM (JAM)</div></th>
                                    <th><div align="center">BEBAN PADAM (KWH)</div></th>
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
                                <?php
                                $p      = new Paging;
                                $batas  = 10;
                                $posisi = $p->cariPosisi($batas);
                                $jmldata= $conn->numRows("REKAP_SAIDI");
                                $jmlcol = $conn->numCols("REKAP_SAIDI");
                                $query  = $conn->queryPaging("KODE", "REKAP_SAIDI", $posisi, $batas);
                                $query->execute();
                                while ($row = $query->fetch()) {
                                    echo "<tr>";
                                    for($i=1; $i<= $jmlcol; $i++) {
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