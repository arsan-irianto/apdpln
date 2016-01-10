<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 09/01/2016
 * Time: 22:11
 */

include("../../config/connect.php");
include("../../library/class_paging.php");
include("../../library/functions.php");

$tanggal=date("YmdHis");
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=fgtm_".$_GET['cbo_year'].$_GET['cbo_month']."_".$tanggal.".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<style>
    td{white-space: nowrap}
</style>
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
        <tbody>
        <?php
        $sp = "{:retval = CALL PCDR_FGTM_FULL (@BULAN=:bulan,@TAHUN=:tahun)}";
        $result = $conn->prepare($sp);

        $retval = null;
        //$bulan = 10;
        //$tahun = 2015;
        $bulan = $_GET['cbo_month'];
        $tahun = $_GET['cbo_year'];

        $result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
        $result->bindParam('bulan', $bulan, PDO::PARAM_INT);
        $result->bindParam('tahun', $tahun, PDO::PARAM_INT);

        $result->execute();
        $i = 0;
        $n = 1;
        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
            $JUMLAH_I = $row["I1"]+$row["I2"]+ $row["I3"]+$row["I4"];
            $JUMLAH_E = $row["E1"]+$row["E2"]+$row["E3"]+$row["E4"];
            $JUMLAH_GANGGUAN = $row["BESAR5"]+$row["KECIL5"];
            $GANGGUANBESAR = @($row["BESAR5"] / $row["PANJANG"]);
            $GANGGUANTOTAL = @($row["BESAR5"] + $row["KECIL5"]) / $row["PANJANG"];

            echo "<tr>";
            echo "<td>".$n."</td>";
            echo "<td>".$row["AREA"]."</td>";
            echo "<td>".$row["PENYULANG"]."</td>";
            echo "<td>".number_format($row["PANJANG"],2,".",",")."</td>";
            echo "<td>".$row["I1"]."</td>";
            echo "<td>".$row["I2"]."</td>";
            echo "<td>".$row["I3"]."</td>";
            echo "<td>".$row["I4"]."</td>";
            echo "<td>".$JUMLAH_I."</td>";
            echo "<td>".$row["E1"]."</td>";
            echo "<td>".$row["E2"]."</td>";
            echo "<td>".$row["E3"]."</td>";
            echo "<td>".$row["E4"]."</td>";
            echo "<td>".$JUMLAH_E."</td>";
            echo "<td>".$row["BESAR5"]."</td>";
            echo "<td>".$row["KECIL5"]."</td>";
            echo "<td>".$JUMLAH_GANGGUAN."</td>";
            echo "<td>".number_format($GANGGUANBESAR,2,".",",")."</td>";
            echo "<td>".number_format($GANGGUANTOTAL,2,".",",")."</td>";
            echo "</tr>";
            $i++;
            $n++;
        }
        ?>
        </tbody>
    </table>
</div><!-- /.box-body -->