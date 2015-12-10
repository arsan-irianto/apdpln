<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 09/11/2015
 * Time: 11:49
 */
/*
include('library/dbConnection.php');
$dbSettings['dbtype'] = 'sqlsrv';
$dbSettings['hostname'] = 'localhost';
$dbSettings['dbname'] = 'APDPLN';
$dbSettings['username'] = 'arsan';
$dbSettings['password'] = 'a1254n';
$conn = new dbConnection( $dbSettings );
*/

include('config/connect.php');
$query = $conn->getFieldList("LOGSHEET");
$query->execute();
$columns = array();
$values = array();
$i=1;
extract($_POST);
while($row = $query->fetch()){
    $columns[$i] = array($row['All_Columns']=> $row['All_Columns'] );
    $i++;
}


$s = array();
//echo "<pre>";
//print_r($s);
//echo "<pre>";


echo "<pre>";

foreach($columns as $a) {
    foreach($a as $k => $v) {
        $s[$k] = $v;
        //echo  $s[$k] = "'.$k.'" ."=>".$v.",<br>";
        //echo $s[$k]."="."isset($s[$k])? $s[$k] : ''".";"."</br>";
        //echo $s[$k]."="."$s[$k])? $s[$k] : ''".";"."</br>";
        echo "'".$s[$k]."'".",";
    }
}
echo "</pre>";
/*
$query = "select * from Sheet2$";
$result = $conn->prepare($query);
$result->execute();
$i = 0;
while( $row = $result->fetch() )
{
    $rows['data'][$i] = array($row[0],$row[1],$row[2]);
    $i++;
}
*/

/*
$result = array();
$jml = count($rows) - 1;
for($j=0; $j<= $jml; $j++)
{
    //array_push($result, $rows[$j]);
    $result[$j]['data'] = $rows[$j];
}
*/
//print json_encode($rows, JSON_NUMERIC_CHECK);

/*
function navActive($modules){
    $modules = array();
    if($_GET['modules']==$modules){
        return "class='active'";
    }
}
*/



//echo navActive("dashboard");
//echo "<br>";
//echo navActive("dashboard");

?>