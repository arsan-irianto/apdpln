<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 18/11/2015
 * Time: 15:41
 */

include('../../library/Db.php');

/*
$query = "select * from REKAP_FGTM";
$result = $conn->prepare($query);
$result->execute();
*/
$i = 0;

while( $row = Db::fetch("REKAP_FGTM","","") )
{
    $rows['data'][$i] = array($row[0],$row[1]);
    $i++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);

//Db::getConnection();
//$r = Db::fetch("REKAP_FGTM","","");
//echo $r[2];
//display result
/*
echo "<pre>";
print_r($r[2]);
echo "</pre>";
*/
?>