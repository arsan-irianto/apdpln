<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 17/11/2015
 * Time: 14:17
 */

try {
    $hostname = "10.97.97.15";
    $dbname = "tifani2_ne" ;
    $username = "cheeqa" ;
    $pw = "Fatimah02";
    $conn = new mysqli($hostname,$username,$pw,$dbname);
} catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
}

$query = "select * from util_3g_2015 limit 100";
$result = $conn->query($query);
$columns = array();
$i = 0;
while( $row = $result->fetch_array() )
{
    for($i=0; $i<= 26; $i++){
        array_push($columns, $row[$i]);
    }

    $column_list = implode(', ', $columns);
    $rows['data'][$i] = array($column_list);
    $i++;
}

print json_encode($rows, JSON_NUMERIC_CHECK);