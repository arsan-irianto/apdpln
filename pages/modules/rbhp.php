<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 24/01/2016
 * Time: 9:46
 */
?>
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
<script src="modules/rbhp.js" type="text/javascript"></script>
<title> Beban Harian Penyulang</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Laporan
            <small>Rekap Beban Harian Penyulang</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i>Rekap Laporan</a></li>
            <li class="active">Rekap Beban Harian Penyulang</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4"><h3 class="box-title">Rekap Beban Harian Penyulang</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group input-sm" id="tanggal_filter">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="TANGGAL" id="TANGGAL" class="form-control input-sm" data-date-format="yyyy-mm-dd" required="" value="<?=date("Y-m-d");?>" type="text">
                                    </div><!-- /.input group -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="trbhp" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th rowspan="2"><div align="center">DCC</div></th>
                                    <th rowspan="2"><div align="center">Area</div></th>
                                    <th rowspan="2"><div align="center">Gardu Induk</div></th>
                                    <th rowspan="2"><div align="center">Penyulang</div></th>
                                    <th colspan="24"><div align="center">Jam</div></th>
                                </tr>
                                <tr>
                                    <th><div align="center">00</div></th>
                                    <th><div align="center">01</div></th>
                                    <th><div align="center">02</div></th>
                                    <th><div align="center">03</div></th>
                                    <th><div align="center">04</div></th>
                                    <th><div align="center">05</div></th>
                                    <th><div align="center">06</div></th>
                                    <th><div align="center">07</div></th>
                                    <th><div align="center">08</div></th>
                                    <th><div align="center">09</div></th>
                                    <th><div align="center">10</div></th>
                                    <th><div align="center">11</div></th>
                                    <th><div align="center">12</div></th>
                                    <th><div align="center">13</div></th>
                                    <th><div align="center">14</div></th>
                                    <th><div align="center">15</div></th>
                                    <th><div align="center">16</div></th>
                                    <th><div align="center">17</div></th>
                                    <th><div align="center">18</div></th>
                                    <th><div align="center">19</div></th>
                                    <th><div align="center">20</div></th>
                                    <th><div align="center">21</div></th>
                                    <th><div align="center">22</div></th>
                                    <th><div align="center">23</div></th>
                                </tr>
                                </thead>
                                <tbody></tbody>

                            </table>
                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="delModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" name="form_delete" id="form_delete" autocomplete="off">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="act" id="act" value="delete">
                    <input type="hidden" id="delid" name="delid">
                    <p>Yakin akan menghapus data ? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="submitDelete()" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-trash-o"></i> Ya</button>
                    <button type="button" id="closeDel" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> Tidak</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModals" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form Beban Harian Penyulang</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="form_logsheet" name="form_logsheet" class="form-horizontal">
                    <input name="usertype" id="usertype" value="<?php echo $TYPE;?>" type="hidden">
                    <input type="hidden" id="type" name="type">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Parameter Beban</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Beban (per jam)</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">PID</label>
                                    <div class="col-sm-4">
                                        <input class="form-control input-sm" value="<?=$PID=isset($PID)? $PID : '';?>" name="PID" id="PID" type="text" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Feeder Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm typeahead" value="<?=$FEEDERNAME=isset($FEEDERNAME)? $FEEDERNAME : '';?>" name="FEEDERNAME" id="FEEDERNAME" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">GIPID</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm" value="<?=$GIPID=isset($GIPID)? $GIPID : '';?>" name="GIPID" id="GIPID" type="text" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Gardu Induk (GI)</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm typeahead_gi" value="<?=$GI=isset($GI)? $GI : '';?>" name="GI" id="GI" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Area ID</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm" value="<?=$AREAID=isset($AREAID)? $AREAID : '';?>" name="AREAID" id="AREAID" type="text" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Area</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm typeahead_area" value="<?=$AREA=isset($AREA)? $AREA : '';?>" name="AREA" id="AREA" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-sm">
                                    <label class="col-sm-4 control-label">Wilayah</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-sm" value="<?=$DCCID=isset($DCCID)? $DCCID : '';?>" name="DCCID" id="DCCID" type="hidden">
                                        <input class="form-control input-sm" value="<?=$DCC=isset($DCC)? $DCC : '';?>" name="DCC" id="DCC" type="text" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group input-sm" id="tanggal_check">
                                    <label class="col-sm-2 control-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="TANGGAL" id="TANGGAL" class="form-control input-sm" data-date-format="yyyy-mm-dd" required="" value="<?=date("Y-m-d");?>" type="text">
                                        </div><!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">00</label>
                                <input class="form-control input-sm" value="<?=$H0=isset($H0)? $H0 : '';?>" name="H0" id="H0" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">01</label>
                                <input class="form-control input-sm" value="<?=$H1=isset($H1)? $H1 : '';?>" name="H1" id="H1" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">02</label>
                                <input class="form-control input-sm" value="<?=$H2=isset($H2)? $H2 : '';?>" name="H2" id="H2" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">03</label>
                                <input class="form-control input-sm" value="<?=$H3=isset($H3)? $H3 : '';?>" name="H3" id="H3" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">04</label>
                                <input class="form-control input-sm" value="<?=$H4=isset($H4)? $H4 : '';?>" name="H4" id="H4" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">05</label>
                                <input class="form-control input-sm" value="<?=$H5=isset($H5)? $H5 : '';?>" name="H5" id="H5" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">06</label>
                                <input class="form-control input-sm" value="<?=$H6=isset($H6)? $H6 : '';?>" name="H6" id="H6" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">07</label>
                                <input class="form-control input-sm" value="<?=$H7=isset($H7)? $H7 : '';?>" name="H7" id="H7" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">08</label>
                                <input class="form-control input-sm" value="<?=$H8=isset($H8)? $H8 : '';?>" name="H8" id="H8" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">09</label>
                                <input class="form-control input-sm" value="<?=$H9=isset($H9)? $H9 : '';?>" name="H9" id="H9" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">10</label>
                                <input class="form-control input-sm" value="<?=$H10=isset($H10)? $H10 : '';?>" name="H10" id="H10" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">11</label>
                                <input class="form-control input-sm" value="<?=$H11=isset($H11)? $H11 : '';?>" name="H11" id="H11" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">12</label>
                                <input class="form-control input-sm" value="<?=$H12=isset($H12)? $H12 : '';?>" name="H12" id="H12" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">13</label>
                                <input class="form-control input-sm" value="<?=$H13=isset($H13)? $H13 : '';?>" name="H13" id="H13" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">14</label>
                                <input class="form-control input-sm" value="<?=$H14=isset($H14)? $H14 : '';?>" name="H14" id="H14" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">15</label>
                                <input class="form-control input-sm" value="<?=$H15=isset($H15)? $H15 : '';?>" name="H15" id="H15" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">16</label>
                                <input class="form-control input-sm" value="<?=$H16=isset($H16)? $H16 : '';?>" name="H16" id="H16" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">17</label>
                                <input class="form-control input-sm" value="<?=$H17=isset($H17)? $H17 : '';?>" name="H17" id="H17" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">18</label>
                                <input class="form-control input-sm" value="<?=$H18=isset($H18)? $H18 : '';?>" name="H18" id="H18" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">19</label>
                                <input class="form-control input-sm" value="<?=$H19=isset($H19)? $H19 : '';?>" name="H19" id="H19" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">20</label>
                                <input class="form-control input-sm" value="<?=$H20=isset($H20)? $H20 : '';?>" name="H20" id="H20" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">21</label>
                                <input class="form-control input-sm" value="<?=$H21=isset($H21)? $H21 : '';?>" name="H21" id="H21" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">22</label>
                                <input class="form-control input-sm" value="<?=$H22=isset($H22)? $H22 : '';?>" name="H22" id="H22" type="text">
                            </div>
                            <div class="col-sm-1">
                                <label class="col-sm-1 control-label">23</label>
                                <input class="form-control input-sm" value="<?=$H23=isset($H23)? $H23 : '';?>" name="H23" id="H23" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="submitBhp()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
