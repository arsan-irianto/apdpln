<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 14/12/2015
 * Time: 6:17
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
$sp = "{:retval = CALL PCDR_SAIDI_FULL (@BULAN=:bulan,@TAHUN=:tahun, @DCCID=:dccid, @AREAID=:areaid)}";
$result = $conn->prepare($sp);

$retval = null;
$bulan = $_GET['month'];
$tahun = $_GET['year'];
$dccid = $_GET['DCCID'];
$areaid = $_GET['AREAID'];
//$jumlah = floatval("646881.00");//$_GET['month'];
//$kwhrata = floatval("0.968");//$_GET['year'];

$result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
//$result->bindParam('jumlah', $jumlah);
//$result->bindParam('kwhrata', $kwhrata);
$result->bindParam('bulan', $bulan, PDO::PARAM_INT);
$result->bindParam('tahun', $tahun, PDO::PARAM_INT);
$result->bindParam('dccid', $bulan, PDO::PARAM_INT);
$result->bindParam('areaid', $tahun, PDO::PARAM_INT);

$result->execute();
$i = 0;
while( $row = $result->fetch(PDO::FETCH_ASSOC)){
    $rows['data'][$i] = array(
        $row["A_KODE"],
        $row["B_KETSAIDI"],
        $row["C_PELANGGANPADAM"],
        $row["D_MENIT_X_PELANGGANPADAM"],
        number_format($row["E_JAM_X_PELANGGANPADAM"],2,".",","),
        number_format($row["F_MENIT_SAIDI"],2,".",","),
        number_format($row["G_JAM_SAIDI"],2,".",","),
        number_format($row["H_SAIFI"],2,".",","),
        $row["I_JUMLAHGANGGUAN"],
        number_format($row["J_LAMAPADAM"],2,".",","),
        number_format($row["K_BEBAN_PADAM_KWH"],2,".",",")
    );
    $i++;
    //$n++;
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