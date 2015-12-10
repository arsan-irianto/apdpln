<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 06/11/2015
 * Time: 22:23
 */

session_start();

$_SESSION['USERNAME'] = (isset($_SESSION['USERNAME']) ? $_SESSION['USERNAME'] : '');
$_SESSION['DESCR'] = (isset($_SESSION['DESCR']) ? $_SESSION['DESCR'] : '');

include('header.php');
include('navigation.php');
include('content.php');
include('footer.php');

?>
