<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 23/01/2016
 * Time: 22:09
 */

error_reporting(0);
session_start();
include('../../config/connect.php');
include('../../library/functions.php');

$sp = "{:retval = CALL PCDR_GRAFIK_DETAIL (@AREAID=:areaid,
                                            @GIID=:giid,
                                            @BULAN=:bulan,
                                            @TAHUN=:tahun,
                                            @KODEFGTM=:kodefgtm,
                                            @LAMA=:lama,
                                            @RELAY=:relay)}";
$result = $conn->prepare($sp);

$retval = null;
$areaid = !empty($_GET['areaid']) ? $_GET['areaid'] : NULL;
$giid   = !empty($_GET['giid']) ? $_GET['giid'] : NULL;
$bulan  = !empty($_GET['bulan']) ? $_GET['bulan'] : "";
$tahun  = !empty($_GET['tahun']) ? $_GET['tahun'] : "";
$kodefgtm = !empty($_GET['kodefgtm']) ? $_GET['kodefgtm'] : NULL;
$lama   = !empty($_GET['lama']) ? $_GET['lama'] : NULL;
$relay  = !empty($_GET['relay']) ? $_GET['relay'] : NULL;

$result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
$result->bindParam('areaid', $areaid, PDO::PARAM_INT);
$result->bindParam('giid', $giid, PDO::PARAM_INT);
$result->bindParam('bulan', $bulan, PDO::PARAM_INT);
$result->bindParam('tahun', $tahun, PDO::PARAM_INT);
$result->bindParam('kodefgtm', $kodefgtm, PDO::PARAM_STR);
$result->bindParam('lama', $lama, PDO::PARAM_INT);
$result->bindParam('relay', $relay, PDO::PARAM_STR);

$result->execute();

$i = 0;
$n = 1;
while( $row = $result->fetch(PDO::FETCH_ASSOC) )
{

    if( ( $row["LAMA"]== 0 ) || (is_null($row["LAMA"]))) {$lama = 0;}else{ $lama = convertToHIS($row["LAMA"]);}

    $TANGGAL = (is_null($row['TANGGAL']) ? "" : substr($row['TANGGAL'],0,10));
    $TR = (is_null($row['TR']) ? "" : substr($row['TR'],11,8));
    $EX = (is_null($row['EX']) ? "" : substr($row['EX'],11,8));
    $RC = (is_null($row['RC']) ? "" : substr($row['RC'],11,8));
    $OP = (is_null($row['OP']) ? "" : substr($row['OP'],11,8));
    $CL = (is_null($row['CL']) ? "" : substr($row['CL'],11,8));

    $rows['data'][$i] = array($TANGGAL, $row['AREA'],
        $row['GI'], $row['ASUHAN'], $row['PLBSREC'],$TR, $EX, $RC, $OP, $CL, $lama,
        $row['PELANGGANPADAM'], $row['SEGMENGANGGUAN'], $row['KODEPADAM'], $row['GANGGUAN'],
        $row['KELOMPOKGANGGUAN'],$row['KETERANGANGANGGUAN']
    );
    $i++;
    $n++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);
?>
