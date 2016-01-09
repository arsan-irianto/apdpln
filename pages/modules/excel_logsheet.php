<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 08/01/2016
 * Time: 22:14
 */
session_start();
include_once("../../config/connect.php");
include_once("../../library/functions.php");

?>
    <link href="../../plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../font-awesome/css/fonts.googleapis.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../../font-awesome/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- date picker -->
    <link href="../../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="../../dist/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />

    <!-- <script src="../../plugins/datatables/jQuery-2.1.4/jquery-2.1.4.min.js" type="text/javascript"></script> -->
    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/datatables_sum.js" type="text/javascript"></script>
    <script src="../../dist/js/common.js" type="text/javascript"></script>

<script src="../modules/excel_logsheet.js" type="text/javascript"></script>
<style>
    body {
        padding-right: 0px !important
    }
    .modal-open {
        overflow-y: auto;
    }
    td{white-space: nowrap}
    .datepicker{z-index:1200 !important;}
</style>


<!-- Main content -->
<section class="content">

<!-- Your Page Content Here -->
<form id="form1" name="form1" method="get" enctype="multipart/form-data" action="../modules/act_excel_logsheet.php">
    <input type="hidden" name="modules" value="logsheet" >
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-4"><h3 class="box-title">Data Logsheet</h3></div>
                        <div class="col-md-8" align="right">
                            <div class="btn-group" id="btnTable">
                                <a href="#" onclick="javascript:document.forms['form1'].submit();" class="btn btn-default">Excel</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <?php echo combonamabln(1, 12, "cbo_month", "-Month-","form-control input-sm");?>
                        </div>
                        <div class="col-md-2">
                            <?php echo combothn(date("Y")-2, date("Y"), "cbo_year", "-Year-","form-control input-sm");?>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body" id="gridData"></div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</form>

</section><!-- /.content -->

<?php
include_once("../footer.php");
?>