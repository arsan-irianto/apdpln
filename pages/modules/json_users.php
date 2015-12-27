<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 21/12/2015
 * Time: 10:27
 */

session_start();
include('../../config/connect.php');
//include('../../library/functions.php');

$query = "select * from USERS";
$result = $conn->prepare($query);
$result->execute();
$i = 0;
$n = 1;
//$rows[0]['data']= 'Data';
while( $row = $result->fetch() )
{
    $rowEdit = "<a href='#' onClick='showModals(\"$row[USERNAME]\")' class='btn_edit btn btn-xs btn-primary' id='$row[USERNAME]'><i class='fa fa-pencil'></i></a>";
    $tbldelete = "<a class='btn btn-xs btn-danger' onclick='deleteUsers(\"$row[USERNAME]\")'><i class='fa fa-times'></i></a>";
    $session_act = ( ($_SESSION['USERNAME'] <> '') ? $rowEdit.$tbldelete : "<i class='fa fa-pencil'></i><i class='fa fa-times'></i>" );
    $action ="<div class='text-center'><div class='btn-group btn-group-xs'>$session_act</div></div>";

    $rows['data'][$i] = array($action ,$n, $row[0],$row[2],$row[3],$row[4]);
    $i++;
    $n++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);