<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 14/11/2015
 * Time: 7:07
 */

error_reporting(0);
session_start();
include('../../config/connect.php');
include('../../library/functions.php');

$query ="select * from LOGSHEET WHERE Month(TANGGAL)='".$_GET['month']."' AND Year(TANGGAL) ='".$_GET['year']."'";
//$query = "select * from LOGSHEET WHERE MONTH(TANGGAL)='09' AND YEAR(TANGGAL)='2015'";
$result = $conn->query($query);
//$result->execute();
$i = 0;
$n = 1;
while( $row = $result->fetch(PDO::FETCH_ASSOC) )
{

    $lama = dateDiff($row['OP'], $row['CL'], 6);
    //$checkData = "<div class='text-center'><input type='checkbox' id='titleCheckdel'><input type='hidden' class='deldata' name='item[$n][deldata]' value='$row[ID]' disabled></div>";
    //$rowEdit = "<a href='home.php?modules=logsheet&periode=$row[periode]&act=edit&id=$row[ID]' class='btn btn-xs btn-default' id='$row[ID]'><i class='fa fa-pencil'></i></a>";
    //$rowDelete = "<a href='modules/action_logsheet.php?act=delete&id=$row[ID]' onclick='return confirm(\"Sure to Delete?\");' class='alertdel btn btn-xs btn-danger'><i class='fa fa-times'></i></a>";
    $rowEdit = "<a href='#' onClick='showModals($row[ID])' class='btn_edit btn btn-xs btn-primary' id='$row[ID]'><i class='fa fa-pencil'></i></a>";
    $tbldelete = "<a class='btn btn-xs btn-danger' onclick='deleteLogsheet($row[ID])'><i class='fa fa-times'></i></a>";
    $session_act = ( ($_SESSION['USERNAME'] <> '') ? $rowEdit.$tbldelete : "<i class='fa fa-pencil'></i><i class='fa fa-times'></i>" );
    $action ="<div class='text-center'><div class='btn-group btn-group-xs'>$session_act</div></div>";

    $TANGGAL = (is_null($row['TANGGAL']) ? "" : substr($row['TANGGAL'],0,10));
    $TR = (is_null($row['TR']) ? "" : substr($row['TR'],11,8));
    $EX = (is_null($row['EX']) ? "" : substr($row['EX'],11,8));
    $RC = (is_null($row['RC']) ? "" : substr($row['RC'],11,8));
    $OP = (is_null($row['OP']) ? "" : substr($row['OP'],11,8));
    $CL = (is_null($row['CL']) ? "" : substr($row['CL'],11,8));


    $rows['data'][$i] = array( $action, $TANGGAL, $row['PLBSREC'],
        $row['ASUHAN'], $row['AREA'], $row['BEBANPADAM'], $row['RELAY'],$TR, $EX,
        $RC, $OP, $CL, $lama,
        $row['KWH'], $row['MRF'], $row['JEDARC1'], $row['KODEFGTM'],$row['KETFGTM'],$row['KETERANGAN'],$row['KORDINASI'],
        $row['SEGMENGANGGUAN'], $row['TOTALPELANGGAN'],$row['PELANGGANPADAM'],$row['PERSENPELANGGANPADAM'],
        $row['KODESAIDI'], $row['KETSAIDI'], $row['EKSEKUTOR'], $row['SHIFT']
    );
    $i++;
    $n++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);

