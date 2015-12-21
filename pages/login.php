<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 01/12/2015
 * Time: 14:38
 */

require("../config/connect.php");
require('../library/functions.php');

$user =( isset($_POST['USERNAME']) ? $_POST['USERNAME'] : '');
$pass =( isset($_POST['PASSWORD']) ? $_POST['PASSWORD'] : '');
$submitted_username = '';
if(!empty($_POST)){
    $query = "SELECT [USERNAME],[PASSWORD],[TYPE],[DESCR]
              FROM [APDPLN].[dbo].[USERS]
              WHERE [USERNAME] = :USERNAME AND [PASSWORD] = HASHBYTES('md5','".$pass."')";

    $query_params = array(
        ':USERNAME' => $user
    );

    try{
        $stmt = $conn->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
    $login_ok = false;
    $row = $stmt->fetch();
    //print_r($row);

    if($row){
            $login_ok = true;
    }

    if($login_ok){
        //unset($row['SALT']);
        //unset($row['PASSWORD']);
        session_start();
        $_SESSION['USERNAME'] = $row['USERNAME'];
        $_SESSION['PASSWORD'] = $row['PASSWORD'];
        $_SESSION['TYPE'] = $row['TYPE'];
        $_SESSION['DESCR'] = $row['DESCR'];
        //header("Location: ../index.php");
        //die("Redirecting to: secret.php");
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }
    else{
        echo messageAlert("Login Gagal, Username dan Password yang dimasukkan tidak sesuai");
        echo "<meta http-equiv=refresh content=0;url=../index.php>";
        //header("Location: ../index.php");
        //print("Login Failed.");
        //$submitted_username = htmlentities($user, ENT_QUOTES, 'UTF-8');
    }
}
?>
