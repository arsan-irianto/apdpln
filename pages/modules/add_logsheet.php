<script type="text/javascript">

    $(function () {
        $("#KODEFGTM").change(function(){
            $("#KETFGTM").val($("#KODEFGTM :selected").text());
        });
        $("#KODESAIDI").change(function(){
            $("#KETSAIDI").val($("#KODESAIDI :selected").text());
        });
        $("#tanggal_check input").datepicker().on("changeDate", function () {
            $(this).datepicker("hide");
        });
        $('.dttime').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss'
        });
        $('#EX').focus(function(){
            /*
            var secondsPerMinute = 60;
            var minutesPerHour = 60;

            function convertSecondsToHHMMSS(intSecondsToConvert) {
                var hours = convertHours(intSecondsToConvert);
                var minutes = getRemainingMinutes(intSecondsToConvert);
                minutes = (minutes == 60) ? "00" : minutes;
                var seconds = getRemainingSeconds(intSecondsToConvert);
                return hours+":"+minutes;
            }

            function convertHours(intSeconds) {
                var minutes = convertMinutes(intSeconds);
                var hours = Math.floor(minutes/minutesPerHour);
                return hours;
            }
            function convertMinutes(intSeconds) {
                return Math.floor(intSeconds/secondsPerMinute);
            }
            function getRemainingSeconds(intTotalSeconds) {
                return (intTotalSeconds%secondsPerMinute);
            }*/
            function HMStoSec1(T) { // h:m:s
                var A = T.split(/\D+/) ; return (A[0]*60 + +A[1])*60 + +A[2]
            }

            var time1 = HMStoSec1("10:00:00");
            var time2 = HMStoSec1("12:05:00");
            var diff = time2 - time1;
            //alert(diff);
        });
    });
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 22/11/2015
 * Time: 21:07
 */
$act=isset($_GET['act'])? $act : '';
if($act=="addnew"){
    $action = "addnew";
    $header = "Add New";
}
else{
    $header = "Edit";
    $action = "edit";
    $sql = $conn->query("SELECT *,DateName( Month, TANGGAL ) + DateName( Year, TANGGAL ) as periode FROM LOGSHEET WHERE ID='".$_GET['id']."'");
    $data = $sql->fetch(PDO::FETCH_ASSOC);


    $SC = ($act == "edit") ? $data['SC'] : "1";
    $MC = ($act == "edit") ? $data['MC'] : "1";
    $CHK = ($act == "edit") ? $data['CHK'] : "1";
    $PID=($act == "edit") ? $data['PID'] : "";
    $GIPID=($act == "edit") ? $data['GIPID'] : "";
    $OE=($act == "edit") ? $data['OE'] : "1";
    $CE=($act == "edit") ? $data['CE'] : "";
    $EOT=($act == "edit") ? substr($data['EOT'],0,19) : "";
    $ECT=($act == "edit") ? substr($data['ECT'],0,19) : "";
    $OO=($act == "edit") ? $data['OO'] : "";
    $CO=($act == "edit") ? $data['CO'] : "";
    $OT=($act == "edit") ? substr($data['OT'],0,19) : "";
    $CT=($act == "edit") ? substr($data['CT'],0,19) : "";
    $AE=($act == "edit") ? $data['AE'] : "0";
    $DE=($act == "edit") ? $data['DE'] : "0";
    $AT=($act == "edit") ? substr($data['AT'],0,19) : "";
    $DT=($act == "edit") ? substr($data['DT'],0,19) : "";
    $AR=($act == "edit") ? $data['AR'] : "";
    $DR=($act == "edit") ? $data['DR'] : "";
    $TR=($act == "edit") ? substr($data['TR'],0,19) : "";
    $EX=($act == "edit") ? substr($data['EX'],0,19) : "";
    $RC=($act == "edit") ? substr($data['RC'],0,19) : "";
    $OP=($act == "edit") ? substr($data['OP'],0,19) : "";
    $CL=($act == "edit") ? substr($data['CL'],0,19) : "";
    $TANGGAL  = ($act == "edit") ? (is_null($data['TANGGAL']) ? "NULL" : substr($data['TANGGAL'],0,10)) : "";
    $PLBSREC=($act == "edit") ? $data['PLBSREC'] : "";
    $ASUHAN=($act == "edit") ? $data['ASUHAN'] : "";
    $AREA=($act == "edit") ? $data['AREA'] : "";
    $BEBANPADAM=($act == "edit") ? $data['BEBANPADAM'] : "";
    $RELAY=($act == "edit") ? $data['RELAY'] : "";
    $LAMA=($act == "edit") ? $data['LAMA'] : "0";
    $KWH=($act == "edit") ? $data['KWH'] : "0";
    $MRF=($act == "edit") ? $data['MRF'] : "";
    $JEDARC1=($act == "edit") ? $data['JEDARC1'] : "0";
    $KODEFGTM=($act == "edit") ? $data['KODEFGTM'] : "";
    $KETFGTM=($act == "edit") ? $data['KETFGTM'] : "";
    $KETERANGAN=($act == "edit") ? $data['KETERANGAN'] : "";
    $KORDINASI=($act == "edit") ? $data['KORDINASI'] : "";
    $SEGMENGANGGUAN=($act == "edit") ? $data['SEGMENGANGGUAN'] : "";
    $TOTALPELANGGAN=($act == "edit") ? $data['TOTALPELANGGAN'] : "0";
    $PELANGGANPADAM=($act == "edit") ? $data['PELANGGANPADAM'] : "0";
    $PERSENPELANGGANPADAM=($act == "edit") ? $data['PERSENPELANGGANPADAM'] : "0";
    $KODESAIDI=($act == "edit") ? $data['KODESAIDI'] : "";
    $KETSAIDI=($act == "edit") ? $data['KETSAIDI'] : "";
    $EKSEKUTOR=($act == "edit") ? $data['EKSEKUTOR'] : "";
    $SHIFT=($act == "edit") ? $data['SHIFT'] : "";



}

?>

    <div style="min-height: 948px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Logsheet
            <small><?=$header;?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php?modules=dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="home.php?modules=logsheet">Logsheet</a></li>
            <li class="active"><?=$header;?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <!-- left column -->
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Form Logsheet</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <form role="form" id="add_logsheet" name="add_logsheet" method="post" action="<?php echo "modules/action_logsheet.php?act=".$action;?>">
    <input name="periode" id="periode" type="hidden" value="<?=$_GET['periode'];?>">
    <input name="ID" id="ID" type="hidden" value="<?=$_GET['id'];?>">
    <input name="SC" id="SC" type="hidden" value="<?=$SC=isset($SC)? $SC : '1';?>">
    <input name="MC" id="MC" type="hidden" value="<?=$MC=isset($MC)? $MC : '1';?>">
    <input name="CHK" id="CHK" type="hidden" value="<?=$CHK=isset($CHK)? $CHK : '1';?>">
    <div class="box-body">
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group input-sm" id="tanggal_check">
                <label>Tanggal Check</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input name="TANGGAL" id="TANGGAL" type="text" class="form-control input-sm" data-date-format="yyyy-mm-dd" required value="<?=$TANGGAL=isset($TANGGAL)? $TANGGAL : '';?>" />
                </div><!-- /.input group -->
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group input-sm">
                <label>LBSREC</label>
                <?php
                //echo $PLBSREC;
                if($action=="addnew"){
                    $queryPenyulang = "SELECT PLBSREC FROM LBSREC";
                    $conn->cboFillFromTable("PLBSREC",$queryPenyulang,"PLBSREC","PLBSREC", "--Choose--","form-control input-sm","addnew");
                }
                else{
                    $PLBSREC=isset($PLBSREC)? $PLBSREC : '';
                    echo "
                    <input class='form-control input-sm' name='PLBSREC'  id='PLBSREC' type='text' value='$PLBSREC' readonly>";
                }
                ?>
                <!--<input name="PLBSREC" id="PLBSREC" type="hidden" value=""> -->
                <input name="ASUHAN" id="ASUHAN" type="hidden" value="<?=$ASUHAN=isset($ASUHAN)? $ASUHAN : '';?>">
                <input name="AREA" id="AREA" type="hidden" value="<?=$AREA=isset($AREA)? $AREA : '';?>">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>Beban Padam</label>
                <select class="form-control input-sm" name="GIPID" id="GIPID">
                    <option value="0">0</option>
                    <option value="12">123</option>
                </select>
                <input name="BEBANPADAM" id="BEBANPADAM" type="hidden" value="<?=$BEBANPADAM=isset($BEBANPADAM)? $BEBANPADAM : '0';?>">
                <input name="OE" id="OE" type="hidden" value="<?=$OE=isset($OE)? $OE : '1';?>">
                <input name="CE" id="CE" type="hidden" value="<?=$CE=isset($CE)? $CE : '';?>">
                <input name="EOT" id="EOT" type="hidden" value="<?=$EOT=isset($EOT)? $EOT : '';?>">
                <input name="ECT" id="ECT" type="hidden" value="<?=$ECT=isset($ECT)? $ECT : '';?>">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>OO Name</label>
                <input class="form-control input-sm" name="OO" id="OO" placeholder="OO Name" type="text" required value="<?=$OO=isset($OO)? $OO : '';?>">
            </div>
        </div>
        <div class="col-sm-2">
            <label>CO Name</label>
            <input class="form-control input-sm" name="CO" id="CO" placeholder="CO Name" type="text" required value="<?=$CO=isset($CO)? $CO : '';?>">
            <input name="OT" id="OT" type="hidden" value="<?=$OT=isset($OT)? $OT : '';?>">
            <input name="CT" id="CT" type="hidden" value="<?=$CT=isset($CT)? $CT : '';?>">
            <input name="AE" id="AE" type="hidden" value="<?=$AE=isset($AE)? $AE : '0';?>">
            <input name="DE" id="DE" type="hidden" value="<?=$DE=isset($DE)? $DE : '0';?>">
            <input name="AT" id="AT" type="hidden" value="<?=$AT=isset($AT)? $AT : '';?>">
            <input name="DT" id="DT" type="hidden" value="<?=$DT=isset($DT)? $DT : '';?>">
            <input name="AR" id="AR" type="hidden" value="<?=$AR=isset($AR)? $AR : '';?>">
            <input name="DR" id="DR" type="hidden" value="<?=$DR=isset($DR)? $DR : '';?>">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Trip</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control input-sm dttime" value="<?=$TR=isset($TR)? $TR : '';?>" name="TR" id="TR" data-date-format="yyyy-mm-dd hh:ii:ss" placeholder="00:00:00" type="text">
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Execute</label>
                <input class="form-control input-sm dttime" value="<?=$EX=isset($EX)? $EX : '';?>" name="EX" id="EX" placeholder="00:00:00" type="text">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>Reclose</label>
                <input class="form-control input-sm dttime" value="<?=$RC=isset($RC)? $RC : '';?>" name="RC" id="RC" placeholder="00:00:00" type="text">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>Open</label>
                <input class="form-control input-sm dttime" value="<?=$OP=isset($OP)? $OP : '';?>" name="OP" id="OP" placeholder="00:00:00" type="text">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>Close</label>
                <input class="form-control input-sm dttime" <?=$CL=isset($CL)? $CL : '';?> name="CL" id="CL" placeholder="00:00:00" type="text">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Relay</label>
                <input class="form-control input-sm" value="<?=$RELAY=isset($RELAY)? $RELAY : '';?>" name="RELAY" id="RELAY" placeholder="0" type="text">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>Lama</label>
                <input class="form-control input-sm" name="LAMA" id="LAMA" type="text" value="<?=$LAMA=isset($LAMA)? $LAMA : '0';?>" readonly>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>KWH</label>
                <input class="form-control input-sm" value="<?=$KWH=isset($KWH)? $KWH : '0';?>" name="KWH" id="KWH" placeholder="0.000" type="text">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>M/R/F</label>
                <input class="form-control input-sm" <?=$MRF=isset($MRF)? $MRF : '';?> name="MRF" id="MRF" type="text">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group input-sm">
                <label>RC-1</label>
                <input class="form-control input-sm" <?=$JEDARC1=isset($JEDARC1)? $JEDARC1 : '0';?> name="JEDARC1" id="JEDARC1" placeholder="0" type="text">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Kelompok Gangguan</label>
                <?php

                    $queryFGTM = "SELECT KODE,KETFGTM FROM GANGGUANFGTM";

                    if($action=="addnew"){
                        $conn->cboFillFromTable("KODEFGTM",$queryFGTM,"KODE","KETFGTM", "--Choose--","form-control input-sm","addnew");
                    }
                    else{
                        $conn->cboFillFromTable("KODEFGTM",$queryFGTM,"KODE","KETFGTM", $KODEFGTM,"form-control input-sm","edit");
                    }

                ?>
                <input name="KETFGTM" id="KETFGTM" type="hidden" value="<?=$KETFGTM=isset($KETFGTM)? $KETFGTM : '';?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Keterangan</label>
                <input class="form-control input-sm" name="KETERANGAN" id="KETERANGAN" type="text" value="<?=isset($KETERANGAN)? $KETERANGAN : '';?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Koordinasi</label>
                <input class="form-control input-sm" name="KORDINASI" id="KORDINASI" type="text" value="<?=$KORDINASI=isset($KORDINASI)? $KORDINASI : '';?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Segmen Gangguan</label>
                <input class="form-control input-sm" name="SEGMENGANGGUAN" id="SEGMENGANGGUAN" type="text" value="<?=$SEGMENGANGGUAN=isset($SEGMENGANGGUAN)? $SEGMENGANGGUAN : '';?>">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Total Pelanggan</label>
                <input class="form-control input-sm" placeholder="0" value="<?=$TOTALPELANGGAN=isset($TOTALPELANGGAN)? $TOTALPELANGGAN : '0';?>" name="TOTALPELANGGAN" id="TOTALPELANGGAN" type="text" >
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Pelanggan Padam</label>
                <input class="form-control input-sm" value="<?=$PELANGGANPADAM=isset($PELANGGANPADAM)? $PELANGGANPADAM : '0';?>" name="PELANGGANPADAM" id="PELANGGANPADAM" placeholder="0" type="text" >
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>% Pelanggan Padam</label>
                <input class="form-control input-sm" value="<?=$PERSENPELANGGANPADAM=isset($PERSENPELANGGANPADAM)? $PERSENPELANGGANPADAM : '0';?>" name="PERSENPELANGGANPADAM" id="PERSENPELANGGANPADAM" type="text" readonly>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group input-sm">
                <label>Keterangan Padam</label>
                <?php
                //echo $KODESAIDI;
                $querySAIDI = "SELECT KODE,KETSAIDI FROM PADAMSAIDI";
                if($action=="addnew"){
                    $conn->cboFillFromTable("KODESAIDI",$querySAIDI,"KODE","KETSAIDI", "--Choose--","form-control input-sm","addnew");
                }
                else{
                  $conn->cboFillFromTable("KODESAIDI",$querySAIDI,"KODE","KETSAIDI", $KODESAIDI,"form-control input-sm","edit");
                }

                ?>

                <input name="KETSAIDI" id="KETSAIDI" type="hidden" value="<?=$KETSAIDI=isset($KETSAIDI)? $KETSAIDI : '';?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Eksekutor</label>
                <input class="form-control input-sm" value="<?=$EKSEKUTOR=isset($EKSEKUTOR)? $EKSEKUTOR : '';?>" name="EKSEKUTOR" id="EKSEKUTOR" type="text" >
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group input-sm">
                <label>Shift</label>
                <input class="form-control input-sm" value="<?=$SHIFT=isset($SHIFT)? $SHIFT : '';?>" name="SHIFT" id="SHIFT" type="text" >
            </div>
        </div>
    </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group input-sm">
                    <input type="submit" name="submit" id="submit" class="btn btn-sm btn-primary" value="Submit">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group input-sm" align="right">
                    <input type="button" name="submit" id="submit" class="btn btn-sm btn-danger" value="Back" onclick="javascript:history.back();">
                </div>
            </div>
        </div>
    </div>
    </form>
    </div><!-- /.box -->
    </div><!--/.col (left) -->
    <!-- right column -->
    </div>   <!-- /.row -->
    </section><!-- /.content -->
    </div>