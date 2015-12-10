<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/11/2015
 * Time: 21:09
 */

include('../../config/connect.php');
include('../../library/functions.php');

$act    = $_GET['act'];


extract($_POST);
//$periode=isset($periode)? $periode : '';
$SC=isset($SC)? $SC : '';
$MC=isset($MC)? $MC : '';
$CHK=isset($CHK)? $CHK : '';
$PID=isset($PID)? $PID : '';
$GIPID=isset($GIPID)? $GIPID : '';
$OE=isset($OE)? $OE : '';
$CE=isset($CE)? $CE : '';
$EOT=isset($EOT)? $EOT : '';
$ECT=isset($ECT)? $ECT : '';
$OO=isset($OO)? $OO : '';
$CO=isset($CO)? $CO : '';
$OT=isset($OT)? $OT : '';
$CT=isset($CT)? $CT : '';
$AE=isset($AE)? $AE : '';
$DE=isset($DE)? $DE : '';
$AT=isset($AT)? $AT : '';
$DT=isset($DT)? $DT : '';
$AR=isset($AR)? $AR : '';
$DR=isset($DR)? $DR : '';
$TR=isset($TR)? $TR : '';
$EX=isset($EX)? $EX : '';
$RC=isset($RC)? $RC : '';
$OP=isset($OP)? $OP : '';
$CL=isset($CL)? $CL : '';
$TANGGAL=isset($TANGGAL)? $TANGGAL : '';
$PLBSREC=isset($PLBSREC)? $PLBSREC : '';
$ASUHAN=isset($ASUHAN)? $ASUHAN : '';
$AREA=isset($AREA)? $AREA : '';
$BEBANPADAM=isset($BEBANPADAM)? $BEBANPADAM : '';
$RELAY=isset($RELAY)? $RELAY : '';
$LAMA=isset($LAMA)? $LAMA : '';
$KWH=isset($KWH)? $KWH : '';
$MRF=isset($MRF)? $MRF : '';
$JEDARC1=isset($JEDARC1)? $JEDARC1 : '';
$KODEFGTM=isset($KODEFGTM)? $KODEFGTM : '';
$KETFGTM=isset($KETFGTM)? $KETFGTM : '';
$KETERANGAN=isset($KETERANGAN)? $KETERANGAN : '';
$KORDINASI=isset($KORDINASI)? $KORDINASI : '';
$SEGMENGANGGUAN=isset($SEGMENGANGGUAN)? $SEGMENGANGGUAN : '';
$TOTALPELANGGAN=isset($TOTALPELANGGAN)? $TOTALPELANGGAN : '';
$PELANGGANPADAM=isset($PELANGGANPADAM)? $PELANGGANPADAM : '';
$PERSENPELANGGANPADAM=isset($PERSENPELANGGANPADAM)? $PERSENPELANGGANPADAM : '';
$KODESAIDI=isset($KODESAIDI)? $KODESAIDI : '';
$KETSAIDI=isset($KETSAIDI)? $KETSAIDI : '';
$EKSEKUTOR=isset($EKSEKUTOR)? $EKSEKUTOR : '';
$SHIFT=isset($SHIFT)? $SHIFT : '';

$formData = array('SC'=>$SC,
    'MC'=>$MC,
    'CHK'=>$CHK,
    'PID'=>$PID,
    'GIPID'=>$GIPID,
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
    'PLBSREC'=>$PLBSREC,
    'ASUHAN'=>$ASUHAN,
    'AREA'=>$AREA,
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


if ($act=='delete'){
    $sql = "DELETE FROM LOGSHEET WHERE ID = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['ID'], PDO::PARAM_INT);
    $stmt->execute();
    header('location:../home.php?modules=logsheet');
}
elseif($act=='addnew'){
    if(isset($submit)=="Submit"){
        try{
            $conn->insertArray("LOGSHEET", $formData);
            echo messageAlert("Logsheet Added");
            echo "<meta http-equiv=refresh content=0;url=../home.php?modules=logsheet&act=addnew>";
        }
        catch (PDOException $e){
            echo messageAlert( "Failed to get DB handle : " . $e->getMessage());
            echo "<meta http-equiv=refresh content=0;url=../home.php?modules=logsheet&act=addnew>";
            exit;
        }
    }
}
elseif($act=='edit'){
    if(isset($submit)=="Submit"){
        try{
            $conn->updateArray("LOGSHEET", "ID", $ID, $formData);
            echo messageAlert("Logsheet Updated");
            echo "<meta http-equiv=refresh content=0;url=../home.php?modules=logsheet&periode=".$_POST['periode'].">";
        }
        catch (PDOException $e){
            echo messageAlert( "Failed to get DB handle : " . $e->getMessage());
            echo "<meta http-equiv=refresh content=0;url=../home.php?modules=logsheet>";
            exit;
        }
    }
}
?>