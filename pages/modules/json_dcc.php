<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 12/12/2015
 * Time: 22:26
 */
session_start();
$TYPE = isset($_SESSION['TYPE']) ? $_SESSION['TYPE'] : "";
include('../../config/connect.php');
//include('../../library/functions.php');

$query = "select * from DCC";
$result = $conn->prepare($query);
$result->execute();
$i = 0;
//$rows[0]['data']= 'Data';
while( $row = $result->fetch() )
{
    $rowEdit = "<a href='#' onClick='showModals($row[DCCID])' class='btn_edit btn btn-xs btn-primary' id='$row[DCCID]'><i class='fa fa-pencil'></i></a>";
    $tbldelete = "<a class='btn btn-xs btn-danger' onclick='deleteDcc($row[DCCID])'><i class='fa fa-times'></i></a>";
    $session_act = ( $TYPE == 1 ? $rowEdit.$tbldelete : "<i class='fa fa-pencil'></i><i class='fa fa-times'></i>" );
    $action ="<div class='text-center'><div class='btn-group btn-group-xs'>$session_act</div></div>";

    $rows['data'][$i] = array($action ,$row[0],$row[1],$row[2]);
    $i++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);