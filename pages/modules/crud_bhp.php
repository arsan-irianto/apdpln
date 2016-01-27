<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 26/01/2016
 * Time: 15:19
 */

include('../../config/connect.php');
include('../../library/functions.php');

$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
$_GET['query'] = isset($_GET['query']) ? $_GET['query'] : "";
extract($_POST);

$sp = "{:retval = CALL PCDR_LOGSHEET (@DATE=:tanggal,@DCCID=:wilayah)}";
$result = $conn->prepare($sp);

$result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
$result->bindParam('tanggal', $tanggal, PDO::PARAM_STR);
$result->bindParam('wilayah', $wilayah, PDO::PARAM_INT);

$result->execute();


if(isset($_GET['plb'])=="garea"){
    $sql = $conn->query("SELECT	A.[GIID], B.[GI], A.[AREAID], C.[AREA], D.[DCCID], D.[DCC]
            FROM PLBSRECGH A
            LEFT JOIN GI B ON A.GIID = B.GIID
            LEFT JOIN AREA C ON A.AREAID = C.AREAID
            LEFT JOIN DCC D ON D.DCCID =D.DCCID
            WHERE A.PID = '".$_GET['id']."'");
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

if(isset($_GET['ref'])=="feeder"){
    $return = array();
    $sql = $conn->query("SELECT	TOP 10 [NAME]
                                ,[PID]
                                FROM PLBSRECGH
                                WHERE [NAME] LIKE '%".$_GET['query']."%'");
    //$data = $sql->fetch(PDO::FETCH_ASSOC);
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $dt = array('PID'=>$row['PID'],'NAME'=>rtrim($row['NAME'])) ;
        array_push($return, $dt);
    }
    echo json_encode($return);
}

if(isset($_GET['r'])=="gi"){
    $return = array();
    $sql = $conn->query("SELECT	TOP 10 [GIID]
                                ,[GI]
                                FROM GI
                                WHERE [GI] LIKE '%".$_GET['query']."%'");
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $dt = array('ID'=>$row['GIID'],'NAME'=>rtrim($row['GI'])) ;
        array_push($return, $dt);
    }
    echo json_encode($return);
}

if(isset($_GET['a'])=="area"){
    $return = array();
    $sql = $conn->query("SELECT TOP 10 A.AREAID
                          ,A.AREA
                          ,B.DCC
                      FROM [AREA] A
                      INNER JOIN [DCC] B ON A.DCCID = B.DCCID
                                WHERE [AREA] LIKE '%".$_GET['query']."%'");
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $dt = array('ID'=>$row['AREAID'],'NAME'=>rtrim($row['AREA'])) ;
        array_push($return, $dt);
    }
    echo json_encode($return);
}

if(isset($_GET['g'])=="dcc"){
    $sql = $conn->query("SELECT B.DCC
                          FROM [AREA] A
                          INNER JOIN [DCC] B ON A.DCCID = B.DCCID
                          WHERE AREAID = '".$_GET['id']."'");
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
?>