<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 16/01/2016
 * Time: 19:11
 */

include_once("../../config/connect.php");
extract($_POST);
switch($_GET['cat']){
    case "grup":
        if($id<>""){
            $sp_grup = "{:retval = CALL PCDR_PILIHAN_SAIDI_GROUP(@KODEKELOMPOK=:kelompok)}";
            $result = $conn->prepare($sp_grup);
            $retval = null;
            $result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
            $result->bindParam('kelompok', $id, PDO::PARAM_STR);
            $result->execute();
            echo "<select name='KODEGRUP' id='KODEGRUP' class='selectpicker' data-live-search='true'>";
            echo "<option value='' selected='selected'>-Choose-</option>";
            while($data = $result->fetch(PDO::FETCH_ASSOC)){
                $kode =  $data['KODEGRUP'];
                $ket   =  $data['KETGRUP'];
                echo  "<option value='$kode'>$ket</option>";
            }
        }
        break;
    case "kodesaidi":
        if($id<>""){
            $sp_saidi = "{:retval = CALL PCDR_PILIHAN_SAIDI_KODE(@KODEGRUP=:grup)}";
            $result = $conn->prepare($sp_saidi);
            $retval = null;
            $result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
            $result->bindParam('grup', $id, PDO::PARAM_STR);
            $result->execute();
            echo "<option value='' selected='selected'>-Choose-</option>";
            while($data = $result->fetch(PDO::FETCH_ASSOC)){
                $kode =  $data['KODE'];
                $ket   =  $data['KETSAIDI'];
                echo  "<option value='$kode'>$ket</option>";
            }
        }
        break;
    case "segmen":
        if($id<>""){
            $sp_segmen = "{:retval = CALL PCDR_PILIHAN_SEGMEN_GANGGUAN(@PID=:pid)}";
            $result = $conn->prepare($sp_segmen);
            $retval = null;
            $result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
            $result->bindParam('pid', $id, PDO::PARAM_STR);
            $result->execute();
            while($data = $result->fetch(PDO::FETCH_ASSOC)){
                $name =  $data['NAME'];
                echo  "<option value='$name'>$name</option>";
            }
        }
        break;
    case "segmen_padam":
        if($id<>""){
            $sp_segmen = "{:retval = CALL PCDR_PILIHAN_SEGMEN_PADAM(@PID=:pid, @PENYULANG=:penyulang)}";
            $result = $conn->prepare($sp_segmen);
            $retval = null;
            $result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
            $result->bindParam('pid', $id, PDO::PARAM_STR);
            $result->bindParam('penyulang', $penyulang, PDO::PARAM_STR);
            $result->execute();
            while($data = $result->fetch(PDO::FETCH_ASSOC)){
                $name =  $data['SEGMEN'];
                $plgn =  $data['PELANGGAN'];
                echo  "<option value=$plgn>$name</option>";
            }
        }
        break;
}
?>