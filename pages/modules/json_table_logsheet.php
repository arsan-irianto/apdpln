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

$sp = "{:retval = CALL PCDR_LOGSHEET (@DATE=:tanggal,@DCCID=:wilayah)}";
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

//$query ="select * from LOGSHEET WHERE Month(TANGGAL)='".$_GET['month']."' AND Year(TANGGAL) ='".$_GET['year']."'";
//$query = "select * from LOGSHEET WHERE MONTH(TANGGAL)='09' AND YEAR(TANGGAL)='2015'";
//$result = $conn->query($query);
//$result->execute();

$i = 0;
$n = 1;
while( $row = $result->fetch(PDO::FETCH_ASSOC) )
{

    //$lama = dateDiff($row['OP'], $row['CL'], 6);
    //$checkData = "<div class='text-center'><input type='checkbox' id='titleCheckdel'><input type='hidden' class='deldata' name='item[$n][deldata]' value='$row[ID]' disabled></div>";
    //$rowEdit = "<a href='home.php?modules=logsheet&periode=$row[periode]&act=edit&id=$row[ID]' class='btn btn-xs btn-default' id='$row[ID]'><i class='fa fa-pencil'></i></a>";
    //$rowDelete = "<a href='modules/action_logsheet.php?act=delete&id=$row[ID]' onclick='return confirm(\"Sure to Delete?\");' class='alertdel btn btn-xs btn-danger'><i class='fa fa-times'></i></a>";
    if( ( $row["LAMA"]== 0 ) || (is_null($row["LAMA"]))) {$lama = 0;}else{ $lama = convertToHIS($row["LAMA"]);}
    if( ( $row["JEDARC1"]== 0 ) || (is_null($row["JEDARC1"]))) {$jedarc1 = 0;}else{ $jedarc1 = convertToHIS($row["JEDARC1"]);}

    $rowEdit = "<a href='#' onClick='showModals($row[ID])' class='btn_edit btn btn-xs btn-primary' id='$row[ID]'><i class='fa fa-pencil'></i></a>";
    $tbldelete = "<a class='btn btn-xs btn-danger' onclick='deleteLogsheet($row[ID])'><i class='fa fa-times'></i></a>";
    $session_act = ( ($_SESSION['TYPE'] == 1) || ($_SESSION['TYPE'] == 2) || ($_SESSION['TYPE'] == 3)? $rowEdit.$tbldelete : "<i class='fa fa-pencil'></i><i class='fa fa-times'></i>" );
    $action ="<div class='text-center'><div class='btn-group btn-group-xs'>$session_act</div></div>";


    $sc = ( $row['SC']==1 ) ? "<span class='label label-warning'>Manual</span>" : "<span class='label label-success'>Otomatis</span>";
    $mc = ( $row['MC']==1 ) ? "<a href='#' class='mc'><span class='label label-primary'>Checked</span></a>" : "<a href='#' class='mc'><span class='label label-default'>Unchecked</span></a>";

    $TANGGAL = (is_null($row['TANGGAL']) ? "" : substr($row['TANGGAL'],0,10));
    $TR = (is_null($row['TR']) ? "" : substr($row['TR'],11,8));
    $EX = (is_null($row['EX']) ? "" : substr($row['EX'],11,8));
    $RC = (is_null($row['RC']) ? "" : substr($row['RC'],11,8));
    $OP = (is_null($row['OP']) ? "" : substr($row['OP'],11,8));
    $CL = (is_null($row['CL']) ? "" : substr($row['CL'],11,8));


    $rows['data'][$i] = array( $action, $sc, $mc, $TANGGAL, $row['PLBSREC'],
        $row['ASUHAN'], $row['GI'], $row['AREA'], $row['BEBANPADAM'], $row['RELAY'],$TR, $EX,
        $RC, $OP, $CL, $lama,
        $row['MW'], $row['KWH'], $row['MRF'], $jedarc1, $row['KODEFGTM'],$row['KODESIKLUS'],$row['KETFGTM'],$row['KETERANGAN'],$row['KORDINASI'],
        $row['SEGMENGANGGUAN'], $row['TOTALPELANGGAN'],$row['PELANGGANPADAM'],$row['PERSENPELANGGANPADAM'],
        $row['KODESAIDI'], $row['KETSAIDI'], $row['EKSEKUTOR'], $row['SHIFT']
    );
    $i++;
    $n++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);