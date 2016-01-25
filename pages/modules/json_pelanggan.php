<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/01/2016
 * Time: 5:34
 */
session_start();
$TYPE = isset($_SESSION['TYPE']) ? $_SESSION['TYPE'] : "";
include('../../config/connect.php');
//include('../../library/functions.php');

$query = "select * from PELANGGAN";
$result = $conn->prepare($query);
$result->execute();
$i = 0;
//$rows[0]['data']= 'Data';
while( $row = $result->fetch() )
{
    $rowEdit = "<a href='#' onClick='showModals($row[PKEY])' class='btn_edit btn btn-xs btn-primary' id='$row[PKEY]'><i class='fa fa-pencil'></i></a>";
    $tbldelete = "<a class='btn btn-xs btn-danger' onclick='deletePelanggan($row[PKEY])'><i class='fa fa-times'></i></a>";
    $session_act = ( $TYPE == 1) ? $rowEdit.$tbldelete : "<i class='fa fa-pencil'></i><i class='fa fa-times'></i>";
    $action ="<div class='text-center'><div class='btn-group btn-group-xs'>$session_act</div></div>";

    $rows['data'][$i] = array($action ,$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
    $i++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);