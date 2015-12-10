<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 11/11/2015
 * Time: 7:22
 */

extract($_POST);

$columns = array();
$values = array();
$query = $conn->getFieldList("LOGSHEET");
$query->execute();
$i=1;

while($row = $query->fetch()){
    $var_names = isset(${$row['All_Columns']}) ? ${$row['All_Columns']} : '';
    $columns[$i] = array($row['All_Columns']=> $var_names );
    $i++;
}

$formData = array();
foreach($columns as $a) {
    foreach($a as $k => $v) {
        $formData[$k] = $v;
    }
}

if(isset($submit)=="Submit"){
    try{
        $conn->insertArray("LOGSHEET", $formData);
        echo messageAlert( "Logsheet Added");
        echo "<meta http-equiv=refresh content=0;url=home.php?modules=logsheet&act=addnew>";
    }
    catch (PDOException $e){
        echo messageAlert( "Failed to get DB handle : " . $e->getMessage());
        echo "<meta http-equiv=refresh content=0;url=home.php?modules=logsheet&act=addnew>";
        exit;
    }
}

?>

<div style="min-height: 948px;" class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Logsheet
        <small>Add New</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Logsheet</a></li>
        <li class="active">Add New</li>
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
        <form role="form" id="add_logsheet" name="add_logsheet" method="post">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>Check</label>
                            <select class="form-control input-sm" name="CHECKED" id="CHECKED" required>
                                <option value="True" selected>TRUE</option>
                                <option value="False">FALSE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm" id="tanggal_check">
                            <label>Tanggal Check</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="TANGGAL" id="TANGGAL" type="text" class="form-control input-sm" data-date-format="yyyy-mm-dd" required/>
                            </div><!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Penyulang</label>
                    <?php
                        $queryPenyulang = "SELECT KODE_PENYULANG,NAMA_PENYULANG FROM TB_PENYULANG";
                        $conn->cboFillFromTable("PENYULANGLBSRECHGH",$queryPenyulang,"KODE_PENYULANG","NAMA_PENYULANG",
                                    $default="--Choose--","form-control input-sm","add");
                    ?>
                            <!--<select class="form-control input-sm" name="PENYULANGLBSRECHGH" id="PENYULANGLBSRECHGH">
                                <option>P_PALANGGA</option>
                                <option>P_BONTOA</option>
                            </select> -->
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Asuhan</label>
                            <select class="form-control input-sm" name="ASUHAN" id="ASUHAN" required>
                                <option>P_PALANGGA</option>
                                <option>P_BONTOA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>Area</label>
                            <select class="form-control input-sm" name="AREA" id="AREA">
                                <option>P_PALANGGA</option>
                                <option>P_BONTOA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Beban Sebelum Trip</label>
                            <input class="form-control input-sm" name="BEBANBELUMTRIP" id="BEBANBELUMTRIP" placeholder="0" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Beban Padam</label>
                            <input class="form-control input-sm" name="BEBANPADAM" id="BEBANPADAM" placeholder="0" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Relay</label>
                            <input class="form-control input-sm" name="RELAY" id="RELAY" placeholder="0" type="text" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Trip</label>
                            <input class="form-control input-sm" name="WAKTUTRIP" id="WAKTUTRIP" placeholder="00:00:00" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Execute</label>
                            <input class="form-control input-sm" name="WAKTUEXECUTE" id="WAKTUEXECUTE" placeholder="00:00:00" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>Reclose</label>
                            <input class="form-control input-sm" name="WAKTURECLOSE" id="WAKTURECLOSE" placeholder="00:00:00" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>Open</label>
                            <input class="form-control input-sm" name="WAKTUOPEN" id="WAKTUOPEN" placeholder="00:00:00" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>Close</label>
                            <input class="form-control input-sm" name="WAKTUCLOSE" id="WAKTUCLOSE" placeholder="00:00:00" type="text" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Lama</label>
                            <input class="form-control input-sm" name="LAMA" id="LAMA" placeholder="00:00:00" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Kmw</label>
                            <input class="form-control input-sm" name="KWH" id="KWH" placeholder="0" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>M/R/F</label>
                            <input class="form-control input-sm" name="MRF" id="MRF" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>RC-1</label>
                            <input class="form-control input-sm" name="JEDARC1" id="JEDARC1" placeholder="00:00:00" type="text" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Kelompok Gangguan</label>
                            <select class="form-control input-sm" name="KODEFGTM" id="KODEFGTM" required>
                                <option value="1">TIDAK DITEMUKAN</option>
                                <option value="2">PERALATAN JTM</option>
                            </select>
                            <input name="KETFGTM" id="KETFGTM" type="hidden" value="Rele bekerja tanpa penyebab jelas, PMT dapat masuk kembali">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Keterangan</label>
                            <input class="form-control input-sm" name="KETERANGAN" id="KETERANGAN" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Koordinasi</label>
                            <input class="form-control input-sm" name="KORDINASI" id="KORDINASI" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Segmen Gangguan</label>
                            <select class="form-control input-sm" name="SEGMENGANGGUAN" id="SEGMENGANGGUAN" required>
                                <option>Antara LBS Pertamina & LBS Kalampa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Total Pelanggan</label>
                            <input class="form-control input-sm" placeholder="0" name="TOTALPELANGGAN" id="TOTALPELANGGAN" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Pelanggan Padam</label>
                            <input class="form-control input-sm" name="PELANGGANPADAM" id="PELANGGANPADAM" placeholder="0" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>% Pelanggan Padam</label>
                            <input class="form-control input-sm" name="PERSENPELANGGANPADAM" id="PERSENPELANGGANPADAM" placeholder="0" type="text" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Keterangan Padam</label>
                            <select class="form-control input-sm" name="KODESAIDI" id="KODESAIDI" required>
                                <option value="1">Rele bekerja tanpa penyebab jelas, PMT dapat masuk kembali</option>
                            </select>
                            <input name="KETSAIDI" id="KETSAIDI" type="hidden" value="Rele bekerja tanpa penyebab jelas, PMT dapat masuk kembali">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>Eksekutor</label>
                            <input class="form-control input-sm" name="EKSEKUTOR" id="EKSEKUTOR" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group input-sm">
                            <label>Shift</label>
                            <input class="form-control input-sm" name="SHIFT" id="SHIFT" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>Kinerja</label>
                            <input class="form-control input-sm" name="KINERJA" id="KINERJA" type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group input-sm">
                            <label>SCADA</label>
                            <input class="form-control input-sm" name="SCADA" id="SCADA" type="text" required>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group input-sm">
                            <input type="submit" name="submit" id="submit" class="btn btn-sm btn-primary" value="Submit">
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
<?php

?>