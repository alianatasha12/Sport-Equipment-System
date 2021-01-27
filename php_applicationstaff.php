<?php


include("auth.php");  ?>

<?php


require('db.php');

if(isset($_POST['submit'])){


@$staffid =$_POST['staffid'];
@$department = $_POST['department'];
@$position = $_POST['position'];
@$date = $_POST['date'];
@$time = $_POST['time'];
@$type = $_POST['type'];
@$quantity = $_POST['quantity'];
@$period = $_POST['period'];
@$reason = $_POST['reason'];
$trn_date = date("Y-m-d H:i:s");


$insert_staff="INSERT INTO `application_staff` (`staffid`,`department`,`position`,`date`,`time`,`type`,`quantity`,`period`,`reason`,`trn_date`) 
    VALUES ('$staffid','$department','$position','$date','$time','$type','$quantity','$period','$reason','$trn_date')";

$run_staff= mysqli_query($con,$insert_staff);
    
    if($run_staff){
    
    echo "<script>alert ('Succesfully submit')</script>";
	
    }
    else
    {
      echo"<script> alert('error')</script>";
    }


      
  }

?>