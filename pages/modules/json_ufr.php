<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/12/2015
 * Time: 10:22
 */

error_reporting(0);
include('../../config/connect.php');

$sp = "{:retval = CALL PCDR_UFR_TRANSMISI (@BULAN=:bulan,
                                            @TAHUN=:tahun,
                                            @RELAY=:relay,
                                            @WILAYAH=:wilayah)}";
$result = $conn->prepare($sp);

$retval = null;
//$bulan = 10;
//$tahun = 2015;
$bulan = $_GET['month'];
$tahun = $_GET['year'];
$relay = "ufr";
$wilayah = $_GET['wilayah'];

$result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
$result->bindParam('bulan', $bulan, PDO::PARAM_INT);
$result->bindParam('tahun', $tahun, PDO::PARAM_INT);
$result->bindParam('relay', $relay, PDO::PARAM_STR);
$result->bindParam('wilayah', $wilayah, PDO::PARAM_STR);

$result->execute();
$i = 0;
$n = 1;
while( $row = $result->fetch(PDO::FETCH_ASSOC)){
    $WAKTU_LEPAS = (is_null($row['WAKTU_LEPAS']) ? "" : substr($row['WAKTU_LEPAS'],0,16));
    $WAKTU_MASUK = (is_null($row['WAKTU_MASUK']) ? "" : substr($row['WAKTU_MASUK'],0,16));

    $rows['data'][$i] = array(
        $n,
        $row["NAMA_FEEDER"],
        $row["LOAD_AMPERE"],
        $WAKTU_LEPAS,
        $WAKTU_MASUK,
        $row["LAMA"],
        $row["MW"],
        $row["KWH"]);
    $i++;
    $n++;
}
print json_encode($rows, JSON_NUMERIC_CHECK);