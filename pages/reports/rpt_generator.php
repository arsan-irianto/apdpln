<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("class/tcpdf/tcpdf.php");
include_once("class/PHPJasperXML.inc.php");
//include_once ('setting.php');

$date = date("YmdHis");
switch($_GET['name']){
    case "fgtm":
        $xml =  simplexml_load_file("rptFGTM.jrxml");break;
    case "saidi":
        $xml =  simplexml_load_file("rptSAIDI.jrxml");break;
    case "sample":
        $xml =  simplexml_load_file("report6.jrxml");break;
}
//$xml =  simplexml_load_file("RPT_FGTM.jrxml");
//$xml =  simplexml_load_file("RPT_SAIDI.jrxml");

switch($_GET['type']){
    case "pdf":
		//$bulan=$_GET['month'];
		//$tahun=$_GET['year'];
        $PHPJasperXML = new PHPJasperXML();
        //$PHPJasperXML->debugsql=true;
        $PHPJasperXML->arrayParameter=array("bulan"=>$_GET['month'], "tahun"=>$_GET['year']);
        $PHPJasperXML->xml_dismantle($xml);
        //$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
        //$odbc_name='arsan_scada';
        $PHPJasperXML->transferDBtoArray("localhost","arsan","a1254n","arsan_scada","odbc");
        //$PHPJasperXML->odbc_connect("Driver={SQL Server Native Client 10.0};Server=localhost;Database=reportScada;", "arsan", "a1254n");
        $PHPJasperXML->outpage("I","report_" . $GET['name'] . $date. ".pdf");    //page output method I:standard output  D:Download file
        break;
/*     case "xls":
        $PHPJasperXML = new PHPJasperXML("en","XLS");
        //$PHPJasperXML->debugsql=true;
        //$PHPJasperXML->arrayParameter=array("parameter1"=>1);
		$PHPJasperXML->arrayParameter=array("bulan"=>$_GET['month'], "tahun"=>$_GET['year']);
        $PHPJasperXML->xml_dismantle($xml);
        $PHPJasperXML->transferDBtoArray("localhost","arsan","a1254n","arsan_scada","odbc");
        $PHPJasperXML->outpage("I","report.xls");    //page output method I:standard output  D:Download file
		break; */
}
?>
