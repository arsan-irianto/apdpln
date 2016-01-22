<script>
    $(function(){
        var $_GET = {};

        document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
            function decode(s) {
                return decodeURIComponent(s.split("+").join(" "));
            }

            $_GET[decode(arguments[1])] = decode(arguments[2]);
        });
        $("#cbo_month").val($_GET['cbo_month']);
        $("#cbo_year").val($_GET['cbo_year']);

        $("#cbo_month").change(function(){
            $("#period").submit();
        })
    })
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 16/12/2015
 * Time: 23:41
 */

$sp = "{:retval = CALL PCDR_AREA_TRIP (@BULAN=:bulan,@TAHUN=:tahun)}";
$result = $conn->prepare($sp);

$retval = null;
//$bulan = 10;
//$tahun = 2015;

$bulan = isset($_GET['cbo_month']) ? $_GET['cbo_month'] : "";
$tahun = isset($_GET['cbo_year']) ? $_GET['cbo_year'] : "";

$result->bindParam('retval', $retval, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4);
$result->bindParam('bulan', $bulan, PDO::PARAM_INT);
$result->bindParam('tahun', $tahun, PDO::PARAM_INT);

$result->execute();

// If the query returns a valid response, prepare the JSON string
if ($result) {
    // The `$arrData` array holds the chart attributes and data
    $arrData = array(
        "chart" => array(
            "caption" => "Kali Trip Permanen & Temporer Per Area Dist",
            "bgColor" => "#ffffff",
            "borderAlpha"=> "20",
            "canvasBorderAlpha"=> "0",
            "usePlotGradientColor"=> "0",
            "plotBorderAlpha"=> "10",
            "showXAxisLine"=> "1",
            "xAxisLineColor" => "#999999",
            "showValues" => "0",
            "divlineColor" => "#999999",
            "divLineIsDashed" => "1",
            "showAlternateHGridColor" => "0"
        )
    );

    // Define Chart DataSource
    $category = array();
    $seriesname = array();
    $data_permanen = array();
    $data_temporer = array();

    while( $row = $result->fetch() ) {
        array_push($category, array("label" => $row["AREA"]));
        array_push($data_permanen, array("value" => $row["PERMANEN"]));
        array_push($data_temporer, array("value" => $row["TEMPORER"]));
    }

    // Plotting Categories
    $arrData["categories"][] = array("category" => $category);

    // Plotting Series & Data
    array_push($seriesname, array("seriesname"=>"PERMANEN", "data" => $data_permanen));
    array_push($seriesname, array("seriesname"=>"TEMPORER", "data" => $data_temporer));

    // Plotting Series & Data to Dataset
    $arrData["dataset"] = $seriesname;

    /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

    $jsonEncodedData = json_encode($arrData);

    /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

    $columnChart = new FusionCharts("mscolumn2d", "myFirstChart" , 800, 350, "chartContainer", "json", $jsonEncodedData);

    // Render the chart
    $columnChart->render();

    // Close the database connection
    $conn = null;
}
?>

<title> Kali Trip Permanen & Temporer</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Grafik Per Area
            <small>Kali Trip Permanen & Temporer</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-pie-chart"></i> Grafik Per Area</a></li>
            <li class="active">Kali Trip Permanen & Temporer</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Report</h3>
                        <div class="box-tools pull-right">
                            <div class="row">
                                <div class="col-md-7">
                                    <form name="period" id="period" method="get" >
                                        <input type="hidden" name="modules" id="modules" value="xtpt_area">
                                        <?php
                                        echo combonamabln(1, 12, "cbo_month", "-Month-","form-control input-sm");
                                        ?>
                                </div>
                                <div class="col-md-5">
                                    <?php
                                    echo combothn(2013, date("Y"), "cbo_year", "-Year-","form-control input-sm")
                                    ?>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">

                                </p>
                                <div class="chart-responsive">
                                    <!-- Sales Chart Canvas -->
                                    <div id="chartContainer" align="center"></div>
                                </div><!-- /.chart-responsive -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">

                        </div><!-- /.row -->
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
