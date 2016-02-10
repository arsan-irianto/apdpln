<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 30/01/2016
 * Time: 10:51
 */

error_reporting(0);
session_start();
include('../../config/connect.php');
include('../../library/functions.php');

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : "";
if($_SESSION['TYPE'] == 1){
    $wilayah = 0;
    $query = "select * from BEBANHARIANPENYULANG WHERE TANGGAL='".$tanggal."'";
}
else{
    $wilayah = isset($_SESSION['DCCID']) ? $_SESSION['DCCID'] : "";
    $query = "select * from BEBANHARIANPENYULANG WHERE DCCID='".$wilayah."'";
}
$result = $conn->prepare($query);
$result->execute();

$i = 0;
//$n = 1;
while( $row = $result->fetch(PDO::FETCH_ASSOC) )
{
    $rowEdit = "<a href='#' onClick=showModals($row[PID],'$row[TANGGAL]',$row[HOUR]) class='btn_edit btn btn-xs btn-primary' id='$row[PID]'><i class='fa fa-pencil'></i></a>";
    $tbldelete = "<a class='btn btn-xs btn-danger' onclick=deleteBHP($row[PID],'$row[TANGGAL]',$row[HOUR])><i class='fa fa-times'></i></a>";
    $session_act = ( ($_SESSION['TYPE'] == 1) || ($_SESSION['TYPE'] == 2) || ($_SESSION['TYPE'] == 3)? $rowEdit.$tbldelete : "<i class='fa fa-pencil'></i><i class='fa fa-times'></i>" );
    $action ="<div class='text-center'><div class='btn-group btn-group-xs'>$session_act</div></div>";

    $rows['data'][$i] = array($action,
        $row['PID'],
        $row['FEEDERNAME'],
        $row['TANGGAL'],
        $row['HOUR'],
        number_format($row['VALUE'],2,".",","),
        $row['GIID'],
        $row['GI'],
        $row['AREAID'],
        $row['AREA'],
        $row['DCCID'],
        $row['DCC']
    );
    $i++;
    //$n++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);