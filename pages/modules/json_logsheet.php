<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 23/11/2015
 * Time: 14:19
 */

?>

<?php
//include('../../config/connect.php');

/*$query = "select * from LOGSHEET";
$result = $conn->prepare($query);
$result->execute();
*/

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "ID";

/* DB table to use */
$sTable = "LOGSHEET";

/* Database connection information */

$gaSql['user']       = "arsan";
$gaSql['password']   = "a1254n";
$gaSql['db']         = "APDPLN";
$gaSql['server']     = "localhost";


/*
* Columns
* If you don't want all of the columns displayed you need to hardcode $aColumns array with your elements.
* If not this will grab all the columns associated with $sTable
*/
$aColumns = array('ID','SC','MC','CHK','PID','AID','OE','CE','EOT','ECT','OO','CO','AE','DE','AT','DT','AR','DR','TR','EX','RC','OP','CL','TANGGAL','PLBSREC','ASUHAN','AREA','BEBANPADAM','RELAY','LAMA','KWH','MRF','JEDARC1','KODEFGTM','KETFGTM','KETERANGAN','KORDINASI','SEGMENGANGGUAN','TOTALPELANGGAN','PELANGGANPADAM','PERSENPELANGGANPADAM','KODESAIDI','KETSAIDI','EKSEKUTOR','SHIFT');


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * ODBC connection
 */

$connectionInfo = array("UID" => $gaSql['user'], "PWD" => $gaSql['password'], "Database"=>$gaSql['db'],"ReturnDatesAsStrings"=>true);
$gaSql['link'] = sqlsrv_connect( $gaSql['server'], $connectionInfo);
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );


/* Ordering */
$sOrder = "";
if ( isset( $_GET['iSortCol_0'] ) ) {
    $sOrder = "ORDER BY  ";
    for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
        if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
            $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".addslashes( $_GET['sSortDir_'.$i] ) .", ";
        }
    }
    $sOrder = substr_replace( $sOrder, "", -2 );
    if ( $sOrder == "ORDER BY" ) {
        $sOrder = "";
    }
}

/* Filtering */
$sWhere = "";
if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
    $sWhere = "WHERE (";
    for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
        $sWhere .= $aColumns[$i]." LIKE '%".addslashes( $_GET['sSearch'] )."%' OR ";
    }
    $sWhere = substr_replace( $sWhere, "", -3 );
    $sWhere .= ')';
}
/* Individual column filtering */
for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
    if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )  {
        if ( $sWhere == "" ) {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i]." LIKE '%".addslashes($_GET['sSearch_'.$i])."%' ";
    }
}

/* Paging */
$top = (isset($_GET['iDisplayStart']))?((int)$_GET['iDisplayStart']):0 ;
$limit = (isset($_GET['iDisplayLength']))?((int)$_GET['iDisplayLength'] ):10;
$sQuery = "SELECT TOP $limit ".implode(",",$aColumns)."
        FROM $sTable
        $sWhere ".(($sWhere=="")?" WHERE ":" AND ")." $sIndexColumn NOT IN
        (
            SELECT $sIndexColumn FROM
            (
                SELECT TOP $top ".implode(",",$aColumns)."
                FROM $sTable
                $sWhere
                $sOrder
            )
            as [virtTable]
        )
        $sOrder";

$rResult = sqlsrv_query($gaSql['link'],$sQuery) or die("$sQuery: " . sqlsrv_errors());
$sQueryCnt = "SELECT * FROM $sTable $sWhere";
$rResultCnt = sqlsrv_query( $gaSql['link'], $sQueryCnt ,$params, $options) or die (" $sQueryCnt: " . sqlsrv_errors());

$iFilteredTotal = sqlsrv_num_rows( $rResultCnt );

$sQuery = " SELECT * FROM $sTable ";
$rResultTotal = sqlsrv_query( $gaSql['link'], $sQuery ,$params, $options) or die(sqlsrv_errors());
$iTotal = sqlsrv_num_rows( $rResultTotal );

$output = array(
    "sEcho" => intval(isset($_GET['sEcho'])),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

$no = 1;
while ( $aRow = sqlsrv_fetch_array( $rResult ) ) {

    $tanggal = new DateTime($aRow['TANGGAL']);
    $TR = new DateTime($aRow['TR']);
    $EX = new DateTime($aRow['EX']);
    $RC = new DateTime($aRow['RC']);
    $OP = new DateTime($aRow['OP']);
    $CL = new DateTime($aRow['CL']);

    $row = array();
    for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
        if ( $aColumns[$i] != ' ' ) {
            /*
            $v = $aRow[ $aColumns[$i] ];
            $v = mb_check_encoding($v, 'UTF-8') ? $v : utf8_encode($v);
            $row[]=$v;
            */
            $tbldelete = "<a class='btn btn-xs btn-danger alertdel' id='$aRow[ID]'><i class='fa fa-times'></i></a>";
            $checkdata = "<div class='text-center'><input type='checkbox' id='titleCheckdel' /><input type='hidden' class='deldata' name='item[$no][deldata]' value='$aRow[ID]' disabled></div>";

            $row[] = $checkdata;
            $row[] = "<div class='text-center'><div class='btn-group btn-group-xs'>
					<a href='admin.php?mod=layanan&act=edit&id=$aRow[ID]' class='btn btn-xs btn-default' id='$aRow[ID]'><i class='fa fa-pencil'></i></a>
					$tbldelete</div></div>";
            $row[] = $aRow['SC'];
            $row[] = $aRow['MC'];
            $row[] = $tanggal->format("Y-m-d H:i:s");
            $row[] = $aRow['PLBSREC'];
            $row[] = $aRow['ASUHAN'];
            $row[] = $aRow['AREA'];
            $row[] = $aRow['BEBANPADAM'];
            $row[] = $aRow['RELAY'];
            $row[] = $TR->format("Y-m-d H:i:s");
            $row[] = $EX->format("Y-m-d H:i:s");
            $row[] = $RC->format("Y-m-d H:i:s");
            $row[] = $OP->format("Y-m-d H:i:s");
            $row[] = $CL->format("Y-m-d H:i:s");
            $row[] = $aRow['LAMA'];
            $row[] = $aRow['KWH'];
            $row[] = $aRow['MRF'];
            $row[] = $aRow['JEDARC1'];
            $row[] = $aRow['KODEFGTM'];
            $row[] = $aRow['KETFGTM'];
            $row[] = $aRow['KETERANGAN'];
            $row[] = $aRow['KORDINASI'];
            $row[] = $aRow['SEGMENGANGGUAN'];
            $row[] = $aRow['TOTALPELANGGAN'];
            $row[] = $aRow['PELANGGANPADAM'];
            $row[] = $aRow['PERSENPELANGGANPADAM'];
            $row[] = $aRow['KODESAIDI'];
            $row[] = $aRow['KETSAIDI'];
            $row[] = $aRow['EKSEKUTOR'];
            $row[] = $aRow['SHIFT'];

        }
    }
    If (!empty($row)) { $output['aaData'][] = $row; }
    $no++;
}
echo json_encode( $output );
?>