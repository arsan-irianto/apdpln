<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 08/11/2015
 * Time: 21:19
 */

/**
 * @param $time1
 * @param $time2
 * @param int $precision
 * @return string
 */
function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
        $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
        $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
        $ttime = $time1;
        $time1 = $time2;
        $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
        // Set default diff to 0
        $diffs[$interval] = 0;
        // Create temp time from time1 and interval
        $ttime = strtotime("+1 " . $interval, $time1);
        // Loop until temp time is smaller than time2
        while ($time2 >= $ttime) {
            $time1 = $ttime;
            $diffs[$interval]++;
            // Create new temp time from time1 and interval
            $ttime = strtotime("+1 " . $interval, $time1);
        }
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
        // Break if we have needed precission
        if ($count >= $precision) {
            break;
        }
        // Add value and interval
        // if value is bigger than 0
        if ($value > 0) {
            // Add s if value is not 1
            if ($value != 1) {
                $interval .= "s";
            }
            // Add value and interval to times array
            $times[] = $value . " " . $interval;
            $count++;
        }
    }

    // Return string with times
    if( ($time1==0) || ($time2==0) || ($time1=="") || ($time2=="") || (is_null($time1)) || (is_null($time2)) ){
        return 0;
    }
    else {
        return implode(" ", $times);
    }
}


/**
 * @param $old_time
 * @param $new_time
 * @param string $option
 * @return int|string
 */
function PHPtimeDiff($old_time, $new_time, $option = "int"){
    $old=new DateTime($old_time);
    $new=new DateTime($new_time);
    $timeDifferent = $old->diff($new)->format("%Y-%m-%d %H:%i:%s");
    if($option=="int"){
        $b = strtotime($timeDifferent)-943938000;//797930000;
        return $duration = $b*10000000;
    }
    else{
        return $timeDifferent;
    }
}

/**
 * @param $message
 * Function Show Javascript Alert
 */
function messageAlert($message){
    echo "<script language=\"JavaScript\">
	     window.alert(\"$message\");
	  </script>";
}

/**
 * @param $parameter
 * @return bool|string
 * Function Convert Milisecond to time format HH:MM:SS
 */
function convertMilisecond($parameter){
    $ms = $parameter;
    $s = intval($ms/1000);
    return date('H:i:s', $s);
}

/**
 * @param $old_time
 * @param $new_time
 * @return string
 */
function timeDifference($old_time,$new_time){
    $date1 = strtotime($old_time);
    $date2 = strtotime($new_time);
    $interval = $date2 - $date1;
    $seconds = $interval % 60;
    $minutes = floor(($interval % 3600) / 60);
    $hours = floor($interval / 3600);
    $hh = ( strlen($hours)==1 ) ? "0".$hours : $hours;
    $mm = ( strlen($minutes)==1 ) ? "0".$minutes : $minutes;
    $ss = ( strlen($seconds)==1 ) ? "0".$seconds : $seconds;
    return $hh.":".$mm.":".$ss;
}

/*
$date1 = strtotime("2015-03-09 11:48:19");
$date2 = strtotime("2015-03-09 13:25:33");
$interval = $date2 - $date1;
$seconds = $interval % 60;
$minutes = floor(($interval % 3600) / 60);
$hours = floor($interval / 3600);
//echo $hours.":".$minutes.":".$seconds;
//echo date('h:i:s',$interval);

$old=new DateTime("2015-03-09 11:48:19");
$new=new DateTime("2015-03-09 13:25:33");
$a = $old->diff($new)->format("%H:%i:%s");
$b = strtotime($a);

echo $date1."<br>";
echo $date2."<br>";
echo $a."<br>";
echo $b;
*/

/**
 * @param $awal
 * @param $akhir
 * @param $var
 * @param $terpilih
 */
function combonamabln($awal, $akhir, $var, $terpilih, $class=""){
    $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei",
        "Juni", "Juli", "Agustus", "September",
        "Oktober", "November", "Desember");
    echo "<select name='$var' id='$var' class='$class'>";
    echo "<option value='' selected>$terpilih</option>";
    for ($bln=$awal; $bln<=$akhir; $bln++){
        if ($bln==$terpilih)
            echo "<option value=$bln selected>$nama_bln[$bln]</option>";
        else
            echo "<option value=$bln>$nama_bln[$bln]</option>";
    }
    echo "</select> ";
}

/**
 * @param $awal
 * @param $akhir
 * @param $var
 * @param $terpilih
 */
function combothn($awal, $akhir, $var, $terpilih, $class=""){
    echo "<select name='$var' id='$var' class='$class'>";
    echo "<option value='' selected>$terpilih</option>";
    for ($i=$awal; $i<=$akhir; $i++){
        if ($i==$terpilih)
            echo "<option value=$i selected>$i</option>";
        else
            echo "<option value=$i>$i</option>";
    }
    echo "</select> ";
}

/**
 * @param $var
 * @param $arr_data
 * @param string $default
 * @param string $class
 */
function cboFillFromArray($var,$arr_data,$default="--Choose--",$class=""){
    echo "<select name='$var' id='$var' class='$class'>";
    echo "<option value='' selected>$default</option>";
    foreach($arr_data as $val => $name)
    {
        echo "<option value='$val'>$name</option>";
    }
    echo "</select> ";
}

/*
 * PHP Parsing Date
 $old=new DateTime("2015-10-16 08:29:17");
$new=new DateTime("2015-10-16 10:29:17");
$a = $old->diff($new)->format("%Y-%m-%d %H:%i:%s");
$b = strtotime($a)-943938000;//797930000;
//$durasi = strtotime($b);
$dt = "2015-10-16";
$strdt = strtotime($dt);
$dthasil = $strdt+$b;
$disimpan = $b*10000000;


echo $a."<br>";
echo $b."<br>";
echo date("H:i:s",$dthasil);
echo "<br>";
echo $disimpan;
 *
 */
?>