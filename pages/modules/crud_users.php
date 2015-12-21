<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 21/12/2015
 * Time: 10:27
 */

include('../../config/connect.php');
include('../../library/functions.php');

//$_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
extract($_POST);

$USERNAME=isset($USERNAME)? $USERNAME : '';
$PASSWORD=isset($PASSWORD)? $PASSWORD : '';
$TYPE=isset($TYPE)? $TYPE : '';
$DESC=isset($DESC)? $DESC : '';

$formData = array('USERNAME'=>$USERNAME,
    'TYPE' => $TYPE,
    '[DESCR]'=>$DESC);

$type =(isset($_POST['type']) ? $_POST['type'] : '' );
switch ($type) {

    //Tampilkan Data
    case "get":

        $sql = $conn->query("SELECT [USERNAME] , [PASSWORD], [TYPE],[DESCR] FROM USERS WHERE [USERNAME]='".$_POST['id']."'");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);

        break;

    //Tambah Data
    case "new":

        try{
            $conn->insertArray("USERS", $formData);
            $conn->query("UPDATE [USERS] SET [PASSWORD] = HASHBYTES('md5','".$PASSWORD."')
                          WHERE [USERNAME] = '".$USERNAME."'");
            echo json_encode("OK");
        }
        catch (PDOException $e){
            echo json_encode( "Failed to get DB handle : " . $e->getMessage());
        }
        break;

    //Edit Data
    case "edit":

        try{
            $conn->updateArray("USER", "USERNAME", $USERNAME, $formData);
            $conn->insertArray("USERS", $formData);
            $conn->query("UPDATE [USERS] SET [PASSWORD] = HASHBYTES('md5','".$PASSWORD."')
                          WHERE [USERNAME] = '".$USERNAME."'");
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
    $sql = "DELETE FROM USERS WHERE USERNAME = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $_POST['delid'], PDO::PARAM_INT);
    $stmt->execute();

    if($stmt){
        echo json_encode("OK");
    }
}