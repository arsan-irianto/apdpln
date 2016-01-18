<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 16/01/2016
 * Time: 13:16
 */

include_once("../../config/connect.php");
$id=$_POST['id'];
if($id<>""){
    $sql = $conn->query("SELECT AREAID,AREA FROM [AREA] WHERE DCCID='".$id."'");
    //$data = $sql->fetch(PDO::FETCH_ASSOC);
    echo "<option value='' selected='selected'>-Area-</option>";
    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
        $areaid =  $data['AREAID'];
        $area   =  $data['AREA'];
        echo  "<option value='$areaid'>$area</option>";
    }
}
?>
