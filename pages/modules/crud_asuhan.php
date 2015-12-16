<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 16/12/2015
 * Time: 21:24
 */

include('../../config/connect.php');
include('../../library/functions.php');

//$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
$_GET['query'] = isset($_GET['query']) ? $_GET['query'] : "";
extract($_POST);

$ASUHANID=isset($ASUHANID)? $ASUHANID : '';
$SCADANAME=isset($SCADANAME)? $SCADANAME : '';
$NAME=isset($NAME) ? $NAME : '';
$AREAID=isset($AREAID) ? $AREAID : '';
$GIID=isset($GIID) ? $GIID : '';
$TYPE=isset($TYPE) ? $TYPE : '';
$DESC=isset($DESC)? $DESC : '';
$PANJANGPENYULANG=isset($PANJANGPENYULANG) ? $PANJANGPENYULANG : '';

$formData = array('SCADANAME'=>$SCADANAME,
                    'NAME'=>$NAME,
                    'AREAID'=>$AREAID,
                    'GIID'=>$GIID,
                    'TYPE'=>$TYPE,
                    '[DESC]'=>$DESC,
                    'PANJANGPENYULANG'=>$PANJANGPENYULANG);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT A.[ASUHANID]
                                      ,A.[SCADANAME]
                                      ,A.[NAME]
                                      ,A.[AREAID]
                                      ,A.[GIID]
                                      ,A.[TYPE]
                                      ,A.[DESC] AS DESCR
                                      ,A.[PANJANGPENYULANG]
                                      ,B.GI
                                  FROM [APDPLN].[dbo].[ASUHAN] A
                                  INNER JOIN [APDPLN].[dbo].[GI] B ON A.GIID = B.GIID WHERE [ASUHANID]='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
            $conn->insertArray("ASUHAN", $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("ASUHAN", "ASUHANID", $ASUHANID, $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;
}


if (isset($_POST['act'])=='delete'){
    $sql = "DELETE FROM ASUHAN WHERE ASUHANID = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}

if(isset($_GET['ref'])=="gi"){
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