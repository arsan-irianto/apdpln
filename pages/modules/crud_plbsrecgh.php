<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 16/12/2015
 * Time: 22:33
 */

include('../../config/connect.php');
include('../../library/functions.php');

//$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
$_GET['query'] = isset($_GET['query']) ? $_GET['query'] : "";
extract($_POST);

$PID			= isset($PID) ? $PID : "" ;
$STPOINTNAME    = isset($STPOINTNAME) ? $STPOINTNAME : "";
$ANALOGID       = !empty($ANALOGID) ? $ANALOGID : NULL;
$ANPOINTNAME    = isset($ANPOINTNAME)? $ANPOINTNAME : "";
$RTUID          = !empty($RTUID) ? $RTUID : NULL ;
$RTUNAME        = isset($RTUNAME) ? $RTUNAME : "";
$NAME           = isset($NAME) ? $NAME : "";
$NORMALLYCLOSED = isset($NORMALLYCLOSED) ? $NORMALLYCLOSED : 0;
$ASUHANID1      = !empty($ASUHANID1) ? $ASUHANID1 : NULL;
$ASUHANID2      = !empty($ASUHANID2) ? $ASUHANID2 : NULL;
$GIID           = !empty($GIID) ? $GIID : NULL;
$AREAID         = !empty($AREAID) ? $AREAID : NULL;
$DESC           = isset($DESC) ? $DESC : "";

$formData = array('PID' => $PID,
                    'STPOINTNAME' => $STPOINTNAME,
                    'ANALOGID' => $ANALOGID,
                    'ANPOINTNAME' => $ANPOINTNAME,
                    'RTUID' => $RTUID,
                    'RTUNAME' => $RTUNAME,
                    'NAME' => $NAME,
                    'NORMALLYCLOSED' => $NORMALLYCLOSED,
                    'ASUHANID1' => $ASUHANID1,
                    'ASUHANID2' => $ASUHANID2,
                    'GIID' => $GIID,
                    'AREAID' => $AREAID,
                    '[DESC]' => $DESC);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT [PID]
                                  ,[STPOINTNAME]
                                  ,[ANALOGID]
                                  ,[ANPOINTNAME]
                                  ,[RTUID]
                                  ,[RTUNAME]
                                  ,[NAME]
                                  ,[NORMALLYCLOSED]
                                  ,[ASUHANID1]
                                  ,[ASUHANID2]
                                  ,[GIID]
                                  ,[AREAID]
                                  ,[DESC] AS DESCR
                              FROM [APDPLN].[dbo].[PLBSRECGH] WHERE [PID]='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
            $conn->insertArray("PLBSRECGH", $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("PLBSRECGH", "PID", $PID, $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;
}


if (isset($_POST['act'])=='delete'){
    $sql = "DELETE FROM PLBSRECGH WHERE PID = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}

if(isset($_GET['q'])=="asuhan"){
    $return = array();
    $sql = $conn->query("SELECT	TOP 10 [ASUHANID]
                                ,[NAME]
                                FROM [ASUHAN]
                                WHERE [NAME] LIKE '%".$_GET['query']."%'");
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $dt = array('ID'=>$row['ASUHANID'],'NAME'=>rtrim($row['NAME'])) ;
        array_push($return, $dt);
    }
    echo json_encode($return);
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