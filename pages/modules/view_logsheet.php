<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 08/11/2015
 * Time: 7:25
 */
?>
<script src="modules/view_logsheet.js" type="text/javascript"></script>
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Laporan
            <small>Logsheet</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-book"></i> Rekap Laporan</a></li>
            <li class="active">Logsheet</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <form id="form1" name="form1" method="get" enctype="multipart/form-data" action="modules/act_excel_logsheet.php">
            <input type="hidden" name="modules" value="logsheet" >
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4"><h3 class="box-title">Data Logsheet</h3></div>
                            <div class="col-md-8" align="right">
                                <div class="btn-group" id="btnTable">
                                    <?php if(($TYPE == 1) || ($TYPE == 2))  { ?>
                                        <a href="#" onClick="showModals()" class="btn btn-default">Add</a>
                                    <?php }?>
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

        <!-- /.modal form Logsheet-->
        <div class="modal fade" id="myModals" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 70%">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Form Logsheet</h4>
        </div>
        <div class="modal-body">
        <form role="form" id="form_logsheet" name="form_logsheet" class="form-horizontal">
        <input name="periode" id="periode" value="" type="hidden">
        <input type="hidden" id="type" name="type">
        <input name="ID" id="ID" value="" type="hidden">
        <input name="SC" id="SC" value="" type="hidden">
        <input name="MC" id="MC" value="1" type="hidden">
        <input name="CHK" id="CHK" value="" type="hidden">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Gardu & Area</a></li>
            <li><a href="#tab_2" data-toggle="tab">Detail Pemadaman</a></li>
            <li><a href="#tab_3" data-toggle="tab">Keterangan Gangguan</a></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
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
                        <label class="col-sm-4 control-label">PLBSRECGH</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm typeahead" value="<?=$PLBSRECGH=isset($PLBSRECGH)? $PLBSRECGH : '';?>" name="PLBSRECGH" id="PLBSRECGH" type="text">
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
                            <input class="form-control input-sm" value="<?=$WILAYAH=isset($WILAYAH)? $WILAYAH : '';?>" name="WILAYAH" id="WILAYAH" type="text" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Asuhan</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm typeahead_asuhan" value="<?=$ASUHAN=isset($ASUHAN)? $ASUHAN : '';?>" name="ASUHAN" id="ASUHAN" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group input-sm" id="tanggal_check">
                        <label class="col-sm-4 control-label">Tanggal</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="TANGGAL" id="TANGGAL" class="form-control input-sm" data-date-format="yyyy-mm-dd" required="" value="<?=$TANGGAL=isset($TANGGAL)? $TANGGAL : '';?>" type="text">
                            </div><!-- /.input group -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Trip</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm dttime" value="<?=$TR=isset($TR)? $TR : '';?>" name="TR" id="TR" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Execute</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm dttime" value="<?=$EX=isset($EX)? $EX : '';?>" name="EX" id="EX" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Close</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm dttime" value="<?=$CL=isset($CL)? $CL : '';?>" name="CL" id="CL" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Reclose</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm dttime" value="<?=$RC=isset($RC)? $RC : '';?>" name="RC" id="RC" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Open</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm dttime" value="<?=$OP=isset($OP)? $OP : '';?>" name="OP" id="OP" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Eksekutor</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$EKSEKUTOR=isset($EKSEKUTOR)? $EKSEKUTOR : '';?>" name="EKSEKUTOR" id="EKSEKUTOR" type="text">
                            <input name="CO" id="CO" type="hidden" value="<?=$CO=isset($CO)? $CO : NULL;?>">
                            <input name="OO" id="OO" type="hidden" value="<?=$OO=isset($OO)? $OO : NULL;?>">
                            <input name="OT" id="OT" type="hidden" value="<?=$OT=isset($OT)? $OT : NULL;?>">
                            <input name="CT" id="CT" type="hidden" value="<?=$CT=isset($CT)? $CT : NULL;?>">
                            <input name="AE" id="AE" type="hidden" value="<?=$AE=isset($AE)? $AE : '0';?>">
                            <input name="DE" id="DE" type="hidden" value="<?=$DE=isset($DE)? $DE : '0';?>">
                            <input name="AT" id="AT" type="hidden" value="<?=$AT=isset($AT)? $AT : NULL;?>">
                            <input name="DT" id="DT" type="hidden" value="<?=$DT=isset($DT)? $DT : NULL;?>">
                            <input name="AR" id="AR" type="hidden" value="<?=$AR=isset($AR)? $AR : NULL;?>">
                            <input name="DR" id="DR" type="hidden" value="<?=$DR=isset($DR)? $DR : NULL;?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Shift</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$SHIFT=isset($SHIFT)? $SHIFT : '';?>" name="SHIFT" id="SHIFT" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Relay</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm typeahead_relay" value="<?=$RELAY=isset($RELAY)? $RELAY : '';?>" name="RELAY" id="RELAY" type="text">
                            <input class="form-control input-sm" name="LAMA" id="LAMA" type="hidden" value="<?=$LAMA=isset($LAMA)? $LAMA : '0';?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">KWH</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$KWH=isset($KWH)? $KWH : '0';?>" placeholder="0.000" name="KWH" id="KWH" type="text" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Beban Padam</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$BEBANPADAM=isset($BEBANPADAM)? $BEBANPADAM : '0';?>" name="BEBANPADAM" id="BEBANPADAM" type="text">
                            <input name="OE" id="OE" type="hidden" value="<?=$OE=isset($OE)? $OE : '1';?>">
                            <input name="CE" id="CE" type="hidden" value="<?=$CE=isset($CE)? $CE : '';?>">
                            <input name="EOT" id="EOT" type="hidden" value="<?=$EOT=isset($EOT)? $EOT : '';?>">
                            <input name="ECT" id="ECT" type="hidden" value="<?=$ECT=isset($ECT)? $ECT : '';?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">MW</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="0" placeholder="0.000" name="MW" id="MW" type="text" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Kode FGTM</label>
                        <div class="col-sm-8">
                            <?php
                            $queryFGTM = "SELECT KODE,KODE FROM GANGGUANFGTM";
                            $conn->cboFillFromTable("KODEFGTM",$queryFGTM,"KODE","KODE", "--Choose--","form-control input-sm","addnew");
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">MRF</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$MRF=isset($MRF)? $MRF : '';?>" name="MRF" id="MRF" type="text">
                            <input class="form-control input-sm" <?=$JEDARC1=isset($JEDARC1)? $JEDARC1 : '0';?> name="JEDARC1" id="JEDARC1" placeholder="0" type="hidden">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Keterangan FGTM</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$KETFGTM=isset($KETFGTM)? $KETFGTM : '';?>" name="KETFGTM" id="KETFGTM" type="text" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control input-sm"  name="KETERANGAN" id="KETERANGAN" rows="2" placeholder="Masukkan Keterangan ..."><?=isset($KETERANGAN)? $KETERANGAN : '';?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Kode Siklus</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$KODESIKLUS=isset($KODESIKLUS)? $KODESIKLUS : '';?>"  name="KODESIKLUS" id="KODESIKLUS" type="text">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Kordinasi</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$KORDINASI=isset($KORDINASI)? $KORDINASI : '';?>" name="KORDINASI" id="KORDINASI" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Segmen Gangguan</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$SEGMENGANGGUAN=isset($SEGMENGANGGUAN)? $SEGMENGANGGUAN : '';?>" name="SEGMENGANGGUAN" id="SEGMENGANGGUAN" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Keterangan Saidi</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm typeahead_saidi" value="<?=$KETSAIDI=isset($KETSAIDI)? $KETSAIDI : '';?>" name="KETSAIDI" id="KETSAIDI" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Kode Saidi</label>
                        <div class="col-sm-8">
                            <?php
                            //echo $KODESAIDI;
                            //$querySAIDI = "SELECT KODE FROM PADAMSAIDI";
                            //$conn->cboFillFromTable("KODESAIDI",$querySAIDI,"KODE","KODE", "--Choose--","form-control input-sm","addnew");
                            ?>
                            <input class="form-control input-sm" value="<?=$KODESAIDI=isset($KODESAIDI)? $KODESAIDI : '';?>" name="KODESAIDI" id="KODESAIDI" type="text" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Total Pelanggan</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" placeholder="0" value="<?=$TOTALPELANGGAN=isset($TOTALPELANGGAN)? $TOTALPELANGGAN : '0';?>" name="TOTALPELANGGAN" id="TOTALPELANGGAN" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group input-sm">
                        <label class="col-sm-4 control-label">Pelanggan Padam</label>
                        <div class="col-sm-8">
                            <input class="form-control input-sm" value="<?=$PELANGGANPADAM=isset($PELANGGANPADAM)? $PELANGGANPADAM : '0';?>" name="PELANGGANPADAM" id="PELANGGANPADAM" placeholder="0" type="text" >
                            <input class="form-control input-sm" value="<?=$PERSENPELANGGANPADAM=isset($PELANGGANPADAM)? $PERSENPELANGGANPADAM : '0';?>" name="PERSENPELANGGANPADAM" id="PERSENPELANGGANPADAM" type="hidden" >
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" onClick="submitLogsheet()" class="btn btn-sm btn-primary" data-dismiss="modal">Submit</button>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
        </div>


    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
