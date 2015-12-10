<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 14/11/2015
 * Time: 21:33
 */

error_reporting(0);
include('../../config/connect.php');
/*
$query = "SELECT  a.AREA,a.PENYULANG,a.PANJANG,a.I1,a.I2 ,a.I3 , a.I4,
		a.I1 + a.I2 + a.I3 + a.I4 as JUMLAH_I,
		a.E1, a.E2, a.E3 , a.E4,
		a.E1 + a.E2 + a.E3 + a.E4 as JUMLAH_E,
		a.BESAR5, a.KECIL5,a.BESAR5 + a.KECIL5 as JUMLAH_GANGGUAN,
		 a.BESAR5/a.PANJANG as GANGGUANBESAR,
		(a.BESAR5 + a.KECIL5)/a.PANJANG as GANGGUANTOTAL FROM (
SELECT [WILAYAH]
      ,[PENYULANG]
      ,[PANJANG]
      ,[AREA]
      ,[I1]
      ,[I2]
      ,[I3]
      ,[I4]
      ,[E1]
      ,[E2]
      ,[E3]
      ,[E4]
      ,[BESAR5]
      ,[KECIL5]
  FROM [APDPLN].[dbo].[V_FGTM_FULL]) as a";
*/
$sp = "{:retval = CALL PCDR_FGTM_MAKASSAR_MONTH (@BULAN=:bulan,@TAHUN=:tahun)}";
$result = $conn->prepare($sp);

$retval = null;
//$bulan = 10;
//$tahun = 2015;
$bulan = $_GET['month'];
$tahun = $_GET['year'];

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
    $rows['data'][$i] = array(
        $n,
        $row["AREA"],
        $row["PENYULANG"],
        $row["PANJANG"],
        $row["I1"],
        $row["I2"],
        $row["I3"],
        $row["I4"],
        $JUMLAH_I,
        $row["E1"],
        $row["E2"],
        $row["E3"],
        $row["E4"],
        $JUMLAH_E,
        $row["BESAR5"],
        $row["KECIL5"],
        $JUMLAH_GANGGUAN,
        $GANGGUANBESAR,
        $GANGGUANTOTAL);
    $i++;
    $n++;
}
print json_encode($rows, JSON_NUMERIC_CHECK);
/*
$i = 0;
$n = 1;*/

/*
while( $row = $result->fetch(PDO::FETCH_ASSOC) )
{
    $rows['data'][$i] = array($n, $row["AREA"],$row["PENYULANG"],$row["PANJANG"],$row["I1"],$row["I2"],
        $row["I3"],$row["I4"],$row["JUMLAH_I"],$row["E1"],$row["E2"],
        $row["E3"],$row["E4"],$row["JUMLAH_E"],$row["BESAR5"],$row["KECIL5"],
        $row["JUMLAH_GANGGUAN"],$row["GANGGUANBESAR"],$row["GANGGUANTOTAL"]);
    $i++;
    $n++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);
*/