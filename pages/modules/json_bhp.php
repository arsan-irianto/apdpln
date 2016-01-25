<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/01/2016
 * Time: 9:46
 */

error_reporting(0);
session_start();
include('../../config/connect.php');
include('../../library/functions.php');

$sp = "{:retval = CALL PCDR_BEBANHARIANPENYULANG (@DATE=:tanggal,@DCCID=:wilayah)}";
$result = $conn->prepare($sp);

$retval = null;
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : "";
if($_SESSION['TYPE'] == 1){
    $wilayah = 0;
}
else{
    $wilayah = isset($_SESSION['DCCID']) ? $_SESSION['DCCID'] : "";
}


$result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
$result->bindParam('tanggal', $tanggal, PDO::PARAM_STR);
$result->bindParam('wilayah', $wilayah, PDO::PARAM_INT);

$result->execute();

$i = 0;
//$n = 1;
while( $row = $result->fetch(PDO::FETCH_ASSOC) )
{
    $rows['data'][$i] = array($row["DCC"],$row["AREA"],$row["GI"],$row["FEEDERNAME"],
        number_format($row["H0"],2,".",","),
        number_format($row["H1"],2,".",","),
        number_format($row["H2"],2,".",","),
        number_format($row["H3"],2,".",","),
        number_format($row["H4"],2,".",","),
        number_format($row["H5"],2,".",","),
        number_format($row["H6"],2,".",","),
        number_format($row["H7"],2,".",","),
        number_format($row["H8"],2,".",","),
        number_format($row["H9"],2,".",","),
        number_format($row["H10"],2,".",","),
        number_format($row["H11"],2,".",","),
        number_format($row["H12"],2,".",","),
        number_format($row["H13"],2,".",","),
        number_format($row["H14"],2,".",","),
        number_format($row["H15"],2,".",","),
        number_format($row["H16"],2,".",","),
        number_format($row["H17"],2,".",","),
        number_format($row["H18"],2,".",","),
        number_format($row["H19"],2,".",","),
        number_format($row["H20"],2,".",","),
        number_format($row["H21"],2,".",","),
        number_format($row["H22"],2,".",","),
        number_format($row["H23"],2,".",",")
);
    $i++;
    //$n++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);