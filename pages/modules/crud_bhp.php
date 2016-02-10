<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 30/01/2016
 * Time: 10:51
 */

include('../../config/connect.php');
include('../../library/functions.php');

//$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
extract($_POST);

$PID=isset($PID)? $PID : '';
$FEEDERNAME=isset($FEEDERNAME)? $FEEDERNAME : '';
$TANGGAL=isset($TANGGAL)? $TANGGAL : '';
$HOUR=isset($HOUR)? $HOUR : '';
$VALUE=isset($VALUE)? $VALUE : '';
$GIID=isset($GIID)? $GIID : '';
$GI=isset($GI)? $GI : '';
$AREAID=isset($AREAID)? $AREAID : '';
$AREA=isset($AREA)? $AREA : '';
$DCCID=isset($DCCID)? $DCCID : '';
$DCC=isset($DCC)? $DCC : '';

$formData = array('PID'=>$PID,
    'FEEDERNAME'=>$FEEDERNAME,
    'TANGGAL'=>$TANGGAL,
    'HOUR'=>$HOUR,
    'VALUE'=>$VALUE,
    'GIID'=>$GIID,
    'GI'=>$GI,
    'AREAID'=>$AREAID,
    'AREA'=>$AREA,
    'DCCID'=>$DCCID,
    'DCC'=>$DCC
    );

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT * FROM BEBANHARIANPENYULANG WHERE PID='".$_POST['pid']."'
                             AND TANGGAL='".$_POST['tgl']."' AND HOUR='".$_POST['hour']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":
        try{
            $conn->insertArray("BEBANHARIANPENYULANG", $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            //$conn->updateArray("DCC", "DCCID", $DCCID, $formData);
            //echo json_encode("OK");
            $sql = "UPDATE BEBANHARIANPENYULANG
                          SET FEEDERNAME  =   :FEEDERNAME,
                              VALUE       =   :VALUE,
                              GIID        =   :GIID,
                              GI          =   :GI,
                              AREAID      =   :AREAID,
                              AREA        =   :AREA,
                              DCCID       =   :DCCID,
                              DCC         =   :DCC
                          WHERE PID       =   :PID AND
                                TANGGAL   =   :TANGGAL AND
                                [HOUR]    =   :HOUR";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':PID', $PID, PDO::PARAM_INT);
            $stmt->bindParam(':FEEDERNAME', $FEEDERNAME, PDO::PARAM_STR);
            $stmt->bindParam(':TANGGAL', $TANGGAL, PDO::PARAM_STR);
            $stmt->bindParam(':HOUR', $HOUR, PDO::PARAM_INT);
            $stmt->bindParam(':VALUE', $VALUE, PDO::PARAM_STR);
            $stmt->bindParam(':GIID', $GIID, PDO::PARAM_INT);
            $stmt->bindParam(':GI', $GI, PDO::PARAM_STR);
            $stmt->bindParam(':AREAID', $AREAID, PDO::PARAM_INT);
            $stmt->bindParam(':AREA', $AREA, PDO::PARAM_STR);
            $stmt->bindParam(':DCCID', $DCCID, PDO::PARAM_INT);
            $stmt->bindParam(':DCC', $DCC, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt){
                echo json_encode("OK");
            }
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;
}


if (isset($_POST['act'])=='delete'){
    $sql = "DELETE FROM BEBANHARIANPENYULANG WHERE PID = :PID AND TANGGAL = :TANGGAL AND HOUR = :HOUR ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':PID', $_POST['delpid'], PDO::PARAM_INT);
    $stmt->bindParam(':TANGGAL', $_POST['deltanggal'], PDO::PARAM_STR);
    $stmt->bindParam(':HOUR', $_POST['delhour'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}