<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 14/11/2015
 * Time: 21:46
 */

include('../../config/connect.php');

$query = "select * from REKAP_SAIDI";
$result = $conn->prepare($query);
$result->execute();
$i = 0;
//$rows[0]['data']= 'Data';
while( $row = $result->fetch() )
{
    $rows['data'][$i] = array($row[0],$row[1],$row[2],$row[3],$row[4],
        $row[5],$row[6],$row[7],$row[8],$row[9],$row[10]);
    $i++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);