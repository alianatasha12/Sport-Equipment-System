<?php

require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM application_student WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());
header("Location: delete_returnstudent.php"); 
?>