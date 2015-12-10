<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 06/11/2015
 * Time: 23:00
 */

//$aksi="po-component/po-category/proses.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Laporan
            <small>FGTM</small>
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
                        <div class="col-md-8"><h3 class="box-title">Data FGTM</h3></div>
                        <div class="col-md-2" align="right">
                            <div class="btn-group">
                                <a href="reports/rpt_generator.php?name=fgtm&type=pdf" target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-print"></span> pdf</a>
                                <a href="reports/rpt_generator.php?name=fgtm&type=xls" target="_blank" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-list"></span> excel</a>
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
                        <?php
                        $p      = new Paging;
                        $batas  = 10;
                        $posisi = $p->cariPosisi($batas);
                        $jmldata= $conn->numRows("REKAP_FGTM");
                        $jmlcol = $conn->numCols("REKAP_FGTM");
                        $query  = $conn->queryPaging("KODE_UNIT", "REKAP_FGTM", $posisi, $batas);
                        $query->execute();
                            while ($row = $query->fetch()) {
                                echo "<tr>";
                                for($i=0; $i<=18; $i++) {
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

