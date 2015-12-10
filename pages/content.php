<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 06/11/2015
 * Time: 22:22
 */

include('../config/connect.php');
include('../library/functions.php');
include('../library/class_paging.php');
include('../library/fusioncharts.php');

$modules = ( isset($_GET['modules']) ? $_GET['modules'] : '' );
$act    = ( isset($_GET['act']) ? $_GET['act'] : '' );

switch($modules){
    case "dashboard":
        include('dashboard.php');break;
    case "fgtm":
        include('modules/table_fgtm.php');break;
    case "saidi":
        include('modules/table_saidi.php');break;
    case "logsheet":
        switch($act){
            default:
                include('modules/logsheet.php');break;
            case "addnew":
                include('modules/add_logsheet.php');break;
            case "edit":
                include('modules/add_logsheet.php');break;
        }
        break;
    case "test":
        include('modules/alert_test.php');break;
}
?>

