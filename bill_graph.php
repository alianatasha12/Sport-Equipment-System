<?php  
require_once('header.php');
include("db.php");

if (isset($_GET["year"])) {
  $year = $_GET["year"];
}
else{
  $year = '2019';
}

$query = "SELECT SUM(`amount`) as amount, `month` FROM bills WHERE `month` BETWEEN '".$year."-01-01' AND '".$year."-12-31' GROUP BY MONTH(`month`)";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

//print_r($result);

//echo $result[0][amount][0];
//echo $result[0]['amount'];
//echo "<br>";
//echo $result[0]['month'];
echo "<br>";
//echo $M1=date("F", strtotime($result[0]['month']));

foreach ($result as $r) {
	//$monthname=date("F", strtotime($r['month']));
	//$stat[$monthname] = $monthname;
	$stat[date("F", strtotime($r['month']))] = $r['amount'];
}

?>  
<!DOCTYPE html>  
<html>  
    <head>  
        <title>Google Charts</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
    </head>  
    <body> 
        <br /><br />
        <div class="container">  
            <h3 align="center">Charts</h3>  
            <br />  
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="panel-title">Monthly Report <?php echo $year; ?></h3>
                        </div>
                        <div class="col-md-3">
                            <select name="month" class="form-control" id="month" onchange="location = this.value;">
                                <option selected="selected" disabled="disabled" value="0">Select Year</option>
                                <option value="bill_graph.php?year=2017">2017</option>
                                <option value="bill_graph.php?year=2018">2018</option>
                                <option value="bill_graph.php?year=2019">2019</option>
                                <option value="bill_graph.php?year=2020">2020</option>
                                <option value="bill_graph.php?year=2021">2021</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="chart_area" style="width: 1000px; height: 620px;"></div>
                </div>
            </div>
        </div>  
    </body>  
</html>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	  google.charts.load('current', {'packages':['bar']});
	  google.charts.setOnLoadCallback(drawChart);

	  function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Year', 'Sales'],
			['Jan', <?php if (isset($stat['January'])) {echo $stat['January'];} else {echo '0';}?>],
			['Feb', <?php if (isset($stat['February'])) {echo $stat['February'];} else {echo '0';}?>],
			['Feb', <?php if (isset($stat['March'])) {echo $stat['March'];} else {echo '0';}?>],
			['Apr', <?php if (isset($stat['April'])) {echo $stat['April'];} else {echo '0';}?>],
			['May', <?php if (isset($stat['May'])) {echo $stat['May'];} else {echo '0';}?>],
			['Jun', <?php if (isset($stat['June'])) {echo $stat['June'];} else {echo '0';}?>],
			['Jul', <?php if (isset($stat['July'])) {echo $stat['July'];} else {echo '0';}?>],
			['Aug', <?php if (isset($stat['August'])) {echo $stat['August'];} else {echo '0';}?>],
			['Sept',<?php if (isset($stat['September'])) {echo $stat['September'];} else {echo '0';}?>],
			['Oct', <?php if (isset($stat['October'])) {echo $stat['October'];} else {echo '0';}?>],
			['Nov', <?php if (isset($stat['November'])) {echo $stat['November'];} else {echo '0';}?>],
			['Dec', <?php if (isset($stat['December'])) {echo $stat['December'];} else {echo '0';}?>]
		]);

		var options = {
		  chart: {
			title: 'Homestay Bills Record',
		  }
		};

		var chart = new google.charts.Bar(document.getElementById('chart_area'));

		chart.draw(data, google.charts.Bar.convertOptions(options));
	  }
</script>


    
