<?php


include("auth.php");  ?>

<?php

 
require('db.php');


$status = "";

if(isset($_POST['new']) && $_POST['new']==1)
{
$trn_date = date("Y-m-d H:i:s");
$staffid =$_REQUEST['staffid'];
$department = $_REQUEST['department'];
$position = $_REQUEST['position'];
$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$type = $_REQUEST['type'];
$quantity = $_REQUEST['quantity'];
$period = $_REQUEST['period'];
$reason = $_REQUEST['reason'];


$ins_query="insert into application_staff (`trn_date`,`staffid`,`department`,`postion`,`date`,`time`,`type`,`quantity`,`period`,`reason`) values ('$trn_date','$staffid','$department','$position','$date','$time','$type','$quantity','$period','$reason')";
mysqli_query($con,$ins_query) or die(mysql_error());
$status = "New Record Inserted Successfully.</br></br><a href=''>View Inserted Record</a>";
}
?>