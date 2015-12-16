<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 16/12/2015
 * Time: 21:04
 */

include('../../config/connect.php');
include('../../library/functions.php');

extract($_POST);

$GIID=isset($GIID)? $GIID : '';
$GI=isset($GI)? $GI : '';
$DCCID=isset($DCCID) ? $DCCID : '';
$DESC=isset($DESC)? $DESC : '';

$formData = array('GI'=>$GI,
    'DCCID'=>$DCCID,
    '[DESC]'=>$DESC);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT [GIID]
                                      ,[GI]
                                      ,[DCCID]
                                      ,[DESC] AS DESCR FROM GI WHERE [GIID]='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
            $conn->insertArray("GI", $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("GI", "GIID", $GIID, $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;
}


if (isset($_POST['act'])=='delete'){
    $sql = "DELETE FROM GI WHERE GIID = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}