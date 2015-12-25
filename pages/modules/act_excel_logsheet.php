<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 25/12/2015
 * Time: 21:48
 */

include("../../config/connect.php");
include("../../library/class_paging.php");
include("../../library/functions.php");

$tanggal=date("YmdHis");
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=logsheet_".$_GET['cbo_year'].$_GET['cbo_month']."_".$tanggal.".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<style>
    td{white-space: nowrap}
</style>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover" id="tlogsheet" style="font-size: 0.9em;">
        <thead>
        <tr>
            <th><div align="center">CHECK</div></th>
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
            <th><div align="center">MW</div></th>
            <th><div align="center">KWH</div></th>
            <th><div align="center">MRF</div></th>
            <th><div align="center">RC 1</div></th>
            <th><div align="center">KODE FGTM</div></th>
            <th><div align="center">KODE SIKLUS</div></th>
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
        <tbody>
        <?php
        $bulan = isset($_GET['cbo_month']) ? $_GET['cbo_month'] : "";
        $tahun = isset($_GET['cbo_year']) ? $_GET['cbo_year'] : "";
        $criteria = "WHERE MONTH(TANGGAL)='".$bulan."' AND YEAR(TANGGAL)='".$tahun."'";

        $p      = new Paging;
        //$batas  = 10;
        //$posisi = $p->cariPosisi($batas);
        $jmldata= $conn->numRows("LOGSHEET", $criteria);
        $jmlcol = $conn->numCols("LOGSHEET");
        $query  = $conn->queryPaging("ID", "LOGSHEET", $criteria, 1, $jmldata);
        $query->execute();

        while ($row = $query->fetch()) {

            $lama = dateDiff($row['OP'], $row['CL'], 6);

            /*
            $rowEdit = "<a href='#' onClick='showModals($row[ID])' class='btn_edit btn btn-xs btn-primary' id='$row[ID]'><i class='fa fa-pencil'></i></a>";
            $tbldelete = "<a class='btn btn-xs btn-danger' onclick='deleteLogsheet($row[ID])'><i class='fa fa-times'></i></a>";
            $session_act = ( isset($_SESSION['TYPE']) == 1 || isset($_SESSION['TYPE']) == 2)? $rowEdit.$tbldelete : "<i class='fa fa-pencil'></i><i class='fa fa-times'></i>" ;
            $action ="<div class='text-center'><div class='btn-group btn-group-xs'>$session_act</div></div>";
            $chk = ( $row['MC']==1 ) ? "<span class='label label-success'>Checked</span>" : "<span class='label label-warning'>Uncheked</span>";*/
            $chk = ( $row['MC']==1 ) ? "TRUE" : "FALSE";

            $TANGGAL = (is_null($row['TANGGAL']) ? "" : substr($row['TANGGAL'],0,10));
            $TR = (is_null($row['TR']) ? "" : substr($row['TR'],11,8));
            $EX = (is_null($row['EX']) ? "" : substr($row['EX'],11,8));
            $RC = (is_null($row['RC']) ? "" : substr($row['RC'],11,8));
            $OP = (is_null($row['OP']) ? "" : substr($row['OP'],11,8));
            $CL = (is_null($row['CL']) ? "" : substr($row['CL'],11,8));

            echo "<tr>";
            echo "<td>".$chk."</td>";
            echo "<td>".$TANGGAL."</td>";
            echo "<td>".$row['PLBSREC']."</td>";
            echo "<td>".$row['ASUHAN']."</td>";
            echo "<td>".$row['AREA']."</td>";
            echo "<td>".$row['BEBANPADAM']."</td>";
            echo "<td>".$row['RELAY']."</td>";
            echo "<td>".$TR."</td>";
            echo "<td>".$EX."</td>";
            echo "<td>".$RC."</td>";
            echo "<td>".$OP."</td>";
            echo "<td>".$CL."</td>";
            echo "<td>".$lama."</td>";
            echo "<td>".$row['MW']."</td>";
            echo "<td>".$row['KWH']."</td>";
            echo "<td>".$row['MRF']."</td>";
            echo "<td>".$row['JEDARC1']."</td>";
            echo "<td>".$row['KODEFGTM']."</td>";
            echo "<td>".$row['KETFGTM']."</td>";
            echo "<td>".$row['KODESIKLUS']."</td>";
            echo "<td>".$row['KETERANGAN']."</td>";
            echo "<td>".$row['KORDINASI']."</td>";
            echo "<td>".$row['SEGMENGANGGUAN']."</td>";
            echo "<td>".$row['TOTALPELANGGAN']."</td>";
            echo "<td>".$row['PELANGGANPADAM']."</td>";
            echo "<td>".$row['PERSENPELANGGANPADAM']."</td>";
            echo "<td>".$row['KODESAIDI']."</td>";
            echo "<td>".$row['KETSAIDI']."</td>";
            echo "<td>".$row['EKSEKUTOR']."</td>";
            echo "<td>".$row['SHIFT']."</td>";
            echo "</tr>";
        }
        //unset($conn); unset($query);

        ?>
        </tbody>
    </table>
</div><!-- /.box-body -->