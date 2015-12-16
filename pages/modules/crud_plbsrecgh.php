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

$PID			= isset($PID) ? $PID : 0 ;
$STPOINTNAME    = isset($STPOINTNAME) ? $STPOINTNAME : "";
$ANALOGID       = isset($ANALOGID) ? $ANALOGID : 0;
$ANPOINTNAME    = isset($ANPOINTNAME)? $ANPOINTNAME : "";
$RTUID          = isset($RTUID) ? $RTUID : 0 ;
$RTUNAME        = isset($RTUNAME) ? $RTUNAME : "";
$NAME           = isset($NAME) ? $NAME : "";
$NORMALLYCLOSED = isset($NORMALLYCLOSED) ? $NORMALLYCLOSED : 0;
$ASUHANID1      = isset($ASUHANID1) ? $ASUHANID1 : 0;
$ASUHANID2      = isset($ASUHANID2) ? $ASUHANID2 : 0;
$GIID           = isset($GIID) ? $GIID : 0;
$AREAID         = isset($AREAID) ? $AREAID : 0;
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