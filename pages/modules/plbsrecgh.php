<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 12/12/2015
 * Time: 23:15
 */
?>
<script src="modules/plbsrecgh.js" type="text/javascript"></script>
<style>
    body {
        padding-right: 0px !important
    }
    .modal-open {
        overflow-y: auto;
    }
    td{white-space: nowrap}

    /*
    #myModals .modal-body
    {
        height:350px;
        overflow:auto;
    }*/
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PLBSRECGH
            <small>Master PLBSRECGH</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Master</a></li>
            <li class="active">PLBSRECGH</li>
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
                            <div class="col-md-4"><h3 class="box-title">Data PLBSRECGH</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                    <?php if ($_SESSION['USERNAME'] != "") { ?>
                                        <a href="#" onClick="showModals()" class="btn btn-default">Add</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tplbsrecgh" style="font-size: 0.9em;">
                                <thead>
                                <tr>
                                    <th><div align="center">ACTION</div></th>
                                    <th><div align="center">PID</div></th>
                                    <th><div align="center">STPOINTNAME</div></th>
                                    <th><div align="center">ANALOGID</div></th>
                                    <th><div align="center">ANPOINTNAME</div></th>
                                    <th><div align="center">RTUID</div></th>
                                    <th><div align="center">RTUNAME</div></th>
                                    <th><div align="center">NAME</div></th>
                                    <th><div align="center">NORMALLYCLOSED</div></th>
                                    <th><div align="center">ASUHANID1</div></th>
                                    <th><div align="center">ASUHANID2</div></th>
                                    <th><div align="center">GIID</div></th>
                                    <th><div align="center">AREAID</div></th>
                                    <th><div align="center">DESC</div></th>
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

<div class="modal fade" id="myModals" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Form PLBSRECGH</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="form_plbsrecgh" name="form_plbsrecgh" class="form-horizontal">
                    <input type="hidden" id="type" name="type">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Data PLB</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Data Asuhan</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">PID</label>
                                        <div class="col-sm-4">
                                            <input class="form-control input-sm" value="<?=$PID=isset($PID)? $PID : '';?>" name="PID" id="PID" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">STPOINTNAME</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="<?=$STPOINTNAME=isset($STPOINTNAME)? $STPOINTNAME : '';?>" name="STPOINTNAME" id="STPOINTNAME" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">ANALOGID</label>
                                        <div class="col-sm-4">
                                            <input class="form-control input-sm" value="<?=$ANALOGID=isset($ANALOGID)? $ANALOGID : '';?>" name="ANALOGID" id="ANALOGID" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">ANPOINTNAME</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="<?=$ANPOINTNAME=isset($ANPOINTNAME)? $ANPOINTNAME : '';?>" name="ANPOINTNAME" id="ANPOINTNAME" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">RTUID</label>
                                        <div class="col-sm-4">
                                            <input class="form-control input-sm" value="<?=$RTUID=isset($RTUID)? $RTUID : '';?>" name="RTUID" id="RTUID" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">RTUNAME</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="<?=$RTUNAME=isset($RTUNAME)? $RTUNAME : '';?>" name="RTUNAME" id="RTUNAME" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">NAME</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="<?=$NAME=isset($NAME)? $NAME : '';?>" name="NAME" id="NAME" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">NORMALLYCLOSED</label>
                                        <div class="col-sm-8">
                                            <?php
                                            $items = array(0=>"NORMALLY OPEN", 1=>"NORMALLY CLOSED");
                                            echo cboFillFromArray("NORMALLYCLOSED", $items, "--Choose--", "form-control input-sm");
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">ASUHAN ID 1</label>
                                        <div class="col-sm-4">
                                            <input class="form-control input-sm" value="<?=$ASUHANID1=isset($ASUHANID1)? $ASUHANID1 : '';?>" name="ASUHANID1" id="ASUHANID1" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">ASUHAN 1</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm typeahead_asuhan1" value="" name="ASUHANNAME1" id="ASUHANNAME1" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">ASUHAN ID 2</label>
                                        <div class="col-sm-4">
                                            <input class="form-control input-sm" value="<?=$ASUHANID2=isset($ASUHANID2)? $ASUHANID2 : '';?>" name="ASUHANID2" id="ASUHANID2" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">ASUHAN 2</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm typeahead_asuhan2" value="" name="ASUHANNAME2" id="ASUHANNAME2" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">GIID</label>
                                        <div class="col-sm-4">
                                            <input class="form-control input-sm" value="<?=$GIID=isset($GIID)? $GIID : '';?>" name="GIID" id="GIID" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">GI Name</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm typeahead_gi" value="" name="GI" id="GI" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">AREA</label>
                                        <div class="col-sm-8">
                                            <?php
                                            $queryAREA = "SELECT AREAID,AREA FROM AREA";
                                            $conn->cboFillFromTable("AREAID",$queryAREA,"AREAID","AREA", "--Choose--","form-control input-sm","addnew");
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-sm">
                                        <label class="col-sm-4 control-label">Description</label>
                                        <div class="col-sm-8">
                                            <input class="form-control input-sm" value="<?=$DESC=isset($DESC)? $DESC : '';?>" name="DESC" id="DESC" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="submitPlbsrecgh()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>