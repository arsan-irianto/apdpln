<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 16/12/2015
 * Time: 20:36
 */

include('../../config/connect.php');
include('../../library/functions.php');

//$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
extract($_POST);

$AREAID=isset($AREAID)? $AREAID : '';
$AREA=isset($AREA)? $AREA : '';
$JUMPENYULANG=isset($JUMPENYULANG) ? $JUMPENYULANG : '';
$PANJANGPENYULANG=isset($PANJANGPENYULANG) ? $PANJANGPENYULANG : '';
$DCCID=isset($DCCID) ? $DCCID : '';
$DESC=isset($DESC)? $DESC : '';

$formData = array('AREA'=>$AREA,
                    'JUMPENYULANG'=>$JUMPENYULANG,
                    'PANJANGPENYULANG'=>$PANJANGPENYULANG,
                    'DCCID'=>$DCCID,
                    '[DESC]'=>$DESC);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT [AREAID]
                                      ,[AREA]
                                      ,[JUMPENYULANG]
                                      ,[PANJANGPENYULANG]
                                      ,[DCCID]
                                      ,[DESC] AS DESCR FROM AREA WHERE [AREAID]='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
            $conn->insertArray("AREA", $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("AREA", "AREAID", $AREAID, $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Hapus Data
    /*
    case "delete":

        $sql = "DELETE FROM DCC WHERE DCCID = :ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ID', $_POST['id'], PDO::PARAM_INT);
        $stmt->execute();

        if($stmt){
            echo json_encode("OK");
        }
        break;
    */
}


if (isset($_POST['act'])=='delete'){
    $sql = "DELETE FROM AREA WHERE AREAID = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}