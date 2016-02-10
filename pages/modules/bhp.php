<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 30/01/2016
 * Time: 10:51
 */
?>
<script src="modules/bhp.js" type="text/javascript"></script>
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
<title>Beban Harian Penyulang</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master
            <small>Beban Harian Penyulang</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i>Master</a></li>
            <li class="active">Beban Harian Penyulang</li>
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
                            <div class="col-md-4"><h3 class="box-title">Beban Harian Penyulang</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                    <?php if(($TYPE == 1) || ($TYPE == 2))  { ?>
                                        <a href="#" onClick="showModals()" class="btn btn-default">Add</a>
                                    <?php }?>
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
                                        <input name="TANGGAL_BHP" id="TANGGAL_BHP" class="form-control input-sm" data-date-format="yyyy-mm-dd" required="" value="<?=date("Y-m-d");?>" type="text">
                                    </div><!-- /.input group -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tbhp" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th><div align="center">ACTION</div></th>
                                    <th><div align="center">PID</div></th>
                                    <th width="150"><div align="center">Feeder Name</div></th>
                                    <th><div align="center">Date</div></th>
                                    <th><div align="center">Hour</div></th>
                                    <th><div align="center">Value</div></th>
                                    <th><div align="center">GIID</div></th>
                                    <th width="140"><div align="center">GI</div></th>
                                    <th><div align="center">AREAID</div></th>
                                    <th><div align="center">AREA</div></th>
                                    <th><div align="center">DCCID</div></th>
                                    <th><div align="center">DCC</div></th>
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
                    <input type="hidden" id="delpid" name="delpid">
                    <input type="hidden" id="deltanggal" name="deltanggal">
                    <input type="hidden" id="delhour" name="delhour">
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
    <form role="form" id="form_bhp" name="form_bhp" class="form-horizontal">
        <input name="usertype" id="usertype" value="<?php echo $TYPE;?>" type="hidden">
        <input type="hidden" id="type" name="type">
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
                    <label class="col-sm-4 control-label">GIID</label>
                    <div class="col-sm-8">
                        <input class="form-control input-sm" value="<?=$GIID=isset($GIID)? $GIID : '';?>" name="GIID" id="GIID" type="text" readonly>
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
            <div class="col-sm-6">
                <div class="form-group input-sm" id="tanggal_check">
                    <label class="col-sm-4 control-label">Tanggal</label>
                    <div class="col-sm-4">
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
            <div class="col-sm-6">
                <div class="form-group input-sm">
                    <label class="col-sm-4 control-label">Hour</label>
                    <div class="col-sm-3">
                        <?php
                        echo combothn(0, 23, "HOUR", $HOUR=isset($HOUR)? $HOUR : '', "form-control input-sm");
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group input-sm">
                    <label class="col-sm-4 control-label">Value</label>
                    <div class="col-sm-3">
                        <input class="form-control input-sm" value="<?=$VALUE=isset($VALUE)? $VALUE : '';?>" name="VALUE" id="VALUE" type="text">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" onClick="submitBHP()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
