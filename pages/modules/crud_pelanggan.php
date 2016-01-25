<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/01/2016
 * Time: 5:34
 */

include('../../config/connect.php');
include('../../library/functions.php');

extract($_POST);

$PKEY=isset($PKEY)? $PKEY : '';
$AREAID=isset($AREAID)? $AREAID : '';
$KODEORDER=isset($KODEORDER) ? $KODEORDER : '';
$PIDFEEDER=isset($PIDFEEDER)? $PIDFEEDER : '';
$FEEDER=isset($FEEDER)? $FEEDER : '';
$SEGMEN=isset($SEGMEN)? $SEGMEN : '';
$PELANGGAN=isset($PELANGGAN)? $PELANGGAN : '';
$KET=isset($KET)? $KET : '';

$formData = array('AREAID'=>$AREAID,
    'KODEORDER'=>$KODEORDER,
    'PIDFEEDER'=>$PIDFEEDER,
    'FEEDER'=>$FEEDER,
    'SEGMEN'=>$SEGMEN,
    'PELANGGAN'=>$PELANGGAN,
    'KET'=>$KET);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT * FROM PELANGGAN WHERE [PKEY]='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
            $conn->insertArray("PELANGGAN", $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("PELANGGAN", "PKEY", $PKEY, $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;
}


if (isset($_POST['act'])=='delete'){
    $sql = "DELETE FROM PELANGGAN WHERE PKEY = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}

if(isset($_GET['ref'])=="feeder"){
    $return = array();
    $sql = $conn->query("SELECT [PID]
      ,[NAME] AS FEEDER
  FROM [APDPLN].[dbo].[PLBSRECGH]
  WHERE POINTTYPE = 1 AND [NAME] LIKE '%".$_GET['query']."%'");
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $dt = array('ID'=>$row['PID'],'NAME'=>rtrim($row['FEEDER'])) ;
        array_push($return, $dt);
    }
    echo json_encode($return);
}

if(isset($_GET['segmen'])=="pid"){
    $return = array();
    $sql = $conn->query("SELECT [NAME] AS SEGMEN FROM [APDPLN].[dbo].[PLBSRECGH]
                  WHERE ASUHANID1 = '".$_GET['pidfeeder']."' AND [NAME] LIKE '%".$_GET['query']."%'");
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $dt = array('NAME'=>rtrim($row['SEGMEN'])) ;
        array_push($return, $dt);
    }
    echo json_encode($return);
}

