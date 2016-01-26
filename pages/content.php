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

$USERNAME = isset($_SESSION['USERNAME']) ? $_SESSION['USERNAME'] : "";
$TYPE = isset($_SESSION['TYPE']) ? $_SESSION['TYPE'] : "";

switch($modules){
    case "dashboard":
        include('dashboard.php');break;
    case "users":
        include('modules/users.php');break;
    case "dcc":
        include('modules/dcc.php');break;
    case "area":
        include('modules/area.php');break;
    case "gi":
        include('modules/gi.php');break;
    case "asuhan":
        include('modules/asuhan.php');break;
    case "plbsrecgh":
        include('modules/plbsrecgh.php');break;
    case "pelanggan":
        include('modules/pelanggan.php');break;
    case "pkb":
        include('modules/pkb.php');break;
    case "fgtm":
        include('modules/table_fgtm.php');break;
    case "saidi":
        include('modules/saidi.php');break;
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
    case "ufr":
        include('modules/ufr.php');break;
    case "transmisi":
        include('modules/transmisi.php');break;
    case "bhp"://beban harian penyulang
        include('modules/bhp.php');break;
    case "test":
        include('modules/alert_test.php');break;

    // Grafik Area//
    case "xtp_area":
        include('modules/grafik_xtp_area.php');break;
    case "xtt_area":
        include('modules/grafik_xtt_area.php');break;
    case "xtpt_area":
        include('modules/grafik_xtpt_area.php');break;
    case "xtpir_area":
        include('modules/grafik_xtpir_area.php');break;
    case "gg_area":
        include('modules/grafik_gangguan_area.php');break;

    // Grafik Gardu Induk//
    case "xtp_gardu":
        include('modules/grafik_xtp_gardu.php');break;
    case "xtt_gardu":
        include('modules/grafik_xtt_gardu.php');break;
    case "xtpt_gardu":
        include('modules/grafik_xtpt_gardu.php');break;
    case "xtpir_gardu":
        include('modules/grafik_xtpir_gardu.php');break;
}
?>


<div id="alertalldel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">Yakin akan menghapus data ? </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" id="confirmdel"><i class="fa fa-trash-o"></i> Ya</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> Tidak</button>
            </div>
        </div>
    </div>
</div>