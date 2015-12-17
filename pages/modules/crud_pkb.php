<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 17/12/2015
 * Time: 10:18
 */

include('../../config/connect.php');
include('../../library/functions.php');

//$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
extract($_POST);

$BULAN = isset($BULAN)? $BULAN : "";
$TAHUN= isset($TAHUN)? $TAHUN : "";
$TOTALPELANGGAN= isset($TOTALPELANGGAN)? $TOTALPELANGGAN : "";
$KWHRATARATAHARIANPELANGGAN=isset($KWHRATARATAHARIANPELANGGAN)? $KWHRATARATAHARIANPELANGGAN : "";
$KWHRATARATAJAMPELANGGAN=isset($KWHRATARATAJAMPELANGGAN)? $KWHRATARATAJAMPELANGGAN : "";

$formData = array('BULAN'=>$BULAN,
                    'TAHUN'=>$TAHUN,
                    'TOTALPELANGGAN'=>$TOTALPELANGGAN,
                    'KWHRATARATAHARIANPELANGGAN'=>$KWHRATARATAHARIANPELANGGAN,
                    'KWHRATARATAJAMPELANGGAN'=>$KWHRATARATAJAMPELANGGAN);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT * FROM [PELANGGANKWHBULANAN] WHERE PKEY='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
            $conn->insertArray("PELANGGANKWHBULANAN", $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("PELANGGANKWHBULANAN", "PKEY", $PKEY, $formData);
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

}


if (isset($_POST['act'])=='delete'){
    $sql = "DELETE FROM PELANGGANKWHBULANAN WHERE PKEY = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}