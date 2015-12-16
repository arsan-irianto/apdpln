<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 05/12/2015
 * Time: 10:37
 */

include('../../config/connect.php');
include('../../library/functions.php');

$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
$_GET['query'] = isset($_GET['query']) ? $_GET['query'] : "";
extract($_POST);
//$periode=isset($periode)? $periode : '';
$SC=isset($SC)? $SC : '';
$MC=isset($MC)? $MC : '';
$CHK=isset($CHK)? $CHK : '';
$PID=isset($PID)? $PID : NULL;
$GIPID=isset($GIPID)? $GIPID : NULL;
$GI=isset($GI)? $GI : NULL;
$OE=isset($OE)? $OE : 0;
$CE=isset($CE)? $CE : 0;
$EOT=!empty($EOT)? $EOT : NULL;
$ECT=!empty($ECT)? $ECT : NULL;
$OO=isset($OO)? $OO : '';
$CO=isset($CO)? $CO : '';
$OT=!empty($OT)? $OT : NULL;
$CT=!empty($CT)? $CT : NULL;
$AE=isset($AE)? $AE : 0;
$DE=isset($DE)? $DE : 0;
$AT=!empty($AT)? $AT : NULL;
$DT=!empty($DT)? $DT : NULL;
$AR=isset($AR)? $AR : '';
$DR=isset($DR)? $DR : '';
$TR=!empty($TR)? $TR : NULL;
$EX=!empty($EX)? $EX : NULL;
$RC=!empty($RC)? $RC : NULL;
$OP=!empty($OP)? $OP : NULL;
$CL=!empty($CL)? $CL : NULL;
$TANGGAL=!empty($TANGGAL)? $TANGGAL : NULL;
$PLBSRECGH=isset($PLBSRECGH)? $PLBSRECGH : '';
$ASUHAN=isset($ASUHAN)? $ASUHAN : '';
$AREA=isset($AREA)? $AREA : NULL;
$AREAID=isset($AREAID)? $AREAID : NULL;
$WILAYAH=isset($WILAYAH)? $WILAYAH : NULL;
$BEBANPADAM=isset($BEBANPADAM)? $BEBANPADAM : 0;
$RELAY=isset($RELAY)? $RELAY : NULL;
$LAMA=isset($LAMA)? $LAMA : 0;
$KWH=isset($KWH)? $KWH : NULL;
$MRF=isset($MRF)? $MRF : '';
$JEDARC1=isset($JEDARC1)? $JEDARC1 : 0;
$KODEFGTM=isset($KODEFGTM)? $KODEFGTM : '';
$KETFGTM=isset($KETFGTM)? $KETFGTM : '';
$KETERANGAN=isset($KETERANGAN)? $KETERANGAN : '';
$KORDINASI=isset($KORDINASI)? $KORDINASI : '';
$SEGMENGANGGUAN=isset($SEGMENGANGGUAN)? $SEGMENGANGGUAN : '';
$TOTALPELANGGAN=isset($TOTALPELANGGAN)? $TOTALPELANGGAN : 0;
$PELANGGANPADAM=isset($PELANGGANPADAM)? $PELANGGANPADAM : 0;
$PERSENPELANGGANPADAM=isset($PERSENPELANGGANPADAM)? $PERSENPELANGGANPADAM : 0;
$KODESAIDI=isset($KODESAIDI)? $KODESAIDI : '';
$KETSAIDI=isset($KETSAIDI)? $KETSAIDI : '';
$EKSEKUTOR=isset($EKSEKUTOR)? $EKSEKUTOR : '';
$SHIFT=isset($SHIFT)? $SHIFT : '';

$formData = array('SC'=>$SC,
    'MC'=>$MC,
    'CHK'=>$CHK,
    'PID'=>$PID,
    'GIPID'=>$GIPID,
    'GI'=>$GI,
    'OE'=>$OE,
    'CE'=>$CE,
    'EOT'=>$EOT,
    'ECT'=>$ECT,
    'OO'=>$OO,
    'CO'=>$CO,
    'OT'=>$OT,
    'CT'=>$CT,
    'AE'=>$AE,
    'DE'=>$DE,
    'AT'=>$AT,
    'DT'=>$DT,
    'AR'=>$AR,
    'DR'=>$DR,
    'TR'=>$TR,
    'EX'=>$EX,
    'RC'=>$RC,
    'OP'=>$OP,
    'CL'=>$CL,
    'TANGGAL'=>$TANGGAL,
    'PLBSREC'=>$PLBSRECGH,
    'ASUHAN'=>$ASUHAN,
    'AREA'=>$AREA,
    'AREAID'=>$AREAID,
    'WIL'=>$WILAYAH,
    'BEBANPADAM'=>$BEBANPADAM,
    'RELAY'=>$RELAY,
    'LAMA'=>$LAMA,
    'KWH'=>$KWH,
    'MRF'=>$MRF,
    'JEDARC1'=>$JEDARC1,
    'KODEFGTM'=>$KODEFGTM,
    'KETFGTM'=>$KETFGTM,
    'KETERANGAN'=>$KETERANGAN,
    'KORDINASI'=>$KORDINASI,
    'SEGMENGANGGUAN'=>$SEGMENGANGGUAN,
    'TOTALPELANGGAN'=>$TOTALPELANGGAN,
    'PELANGGANPADAM'=>$PELANGGANPADAM,
    'PERSENPELANGGANPADAM'=>$PERSENPELANGGANPADAM,
    'KODESAIDI'=>$KODESAIDI,
    'KETSAIDI'=>$KETSAIDI,
    'EKSEKUTOR'=>$EKSEKUTOR,
    'SHIFT'=>$SHIFT);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT *,DateName( Month, TANGGAL ) + DateName( Year, TANGGAL ) as periode FROM LOGSHEET WHERE ID='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
           $conn->insertArray("LOGSHEET", $formData);
           echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("LOGSHEET", "ID", $ID, $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Hapus Data
    /*
    case "delete":

        $sql = "DELETE FROM LOGSHEET WHERE ID = :ID";
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
    $sql = "DELETE FROM LOGSHEET WHERE ID = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}

if(isset($_GET['diff'])=="yes"){
    $op = strtotime(isset($_GET['op']) ? $_GET['op'] : 0);
    $cl = strtotime(isset($_GET['cl']) ? $_GET['cl'] : 0);
    $diffInt = ($cl - $op)*10000000;

// Set start & end time
    $start_time = (isset($_GET['op']) ? $_GET['op'] : 0);
    $end_time = (isset($_GET['cl']) ? $_GET['cl'] : 0);
    //$diffInt = (strtotime($start_time) - strtotime($end_time))*10000000;

// Run and print diff
    $diff =  dateDiff($start_time, $end_time, 6);

    $arr['a1'] = $diffInt;
    $arr['a2'] = $diff;
    echo json_encode($arr);
}


if(isset($_GET['c'])=="persen"){
    $tp = (isset($_GET['tp']) ? $_GET['tp'] : 0);
    $pp = (isset($_GET['pp']) ? $_GET['pp'] : 0);
    $diff1 = ($pp/$tp) * 100 ;
    echo json_encode($diff1);
}

if(isset($_GET['rf'])=="fgtm"){
    $sql = $conn->query("SELECT KETFGTM FROM GANGGUANFGTM WHERE KODE='".$_GET['id']."'");
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    echo $data['KETFGTM'];
}
if(isset($_GET['q'])=="saidi"){
    $return = array();
    $sql = $conn->query("SELECT	TOP 10 [KODE]
                                ,[KETSAIDI]
                                FROM PADAMSAIDI
                                WHERE [KETSAIDI] LIKE '%".$_GET['query']."%'");
    //$data = $sql->fetch(PDO::FETCH_ASSOC);
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $dt = array('ID'=>$row['KODE'],'NAME'=>rtrim($row['KETSAIDI'])) ;
        array_push($return, $dt);
    }
    echo json_encode($return);
}

if(isset($_GET['ref'])=="plbsrecgh"){
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

if(isset($_GET['plb'])=="garea"){
    $sql = $conn->query("SELECT	A.[GIID], B.[GI], A.[AREAID], C.[AREA], E.[DCC]
		                ,D.[NAME] AS ASUHAN
            FROM PLBSRECGH A
            LEFT JOIN GI B ON A.GIID = B.GIID
            LEFT JOIN AREA C ON A.AREAID = C.AREAID
            LEFT JOIN ASUHAN D ON A.ASUHANID1 = D.ASUHANID
            LEFT JOIN DCC E ON C.DCCID =E.DCCID
            WHERE A.PID = '".$_GET['id']."'");
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
