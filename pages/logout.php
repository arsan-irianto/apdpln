<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 02/12/2015
 * Time: 14:25
 */
session_start();
session_destroy();
header("Location: ../index.php");
?>