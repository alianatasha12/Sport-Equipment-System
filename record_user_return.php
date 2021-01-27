<?php
require_once('Connections/db.php'); 
require('db.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<style>
<style>
body {margin:0;font-family:Arial}

.topnav {
  overflow: hidden;
  background-color: #138D75;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}






ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #138D75;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
 
  
   
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
   
}




tr:nth-child(even) {
  background-color: #7FFFD4;
}


label {
    display: block;
    font: 1rem 'Fira Sans', sans-serif;
}

input,
label {
    margin: .4rem 0;
}

.note {
    font-size: .8em;
}

</style>

</head>
<body>


<div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Home</a>
  
    <div class="dropdown">
    <button class="dropbtn">Borrowing Application
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
     
      <a href="user_application_staff.php">Staff Application</a>
     
      <a href="user_application.php">Student Application</a>
   
    </div>
    
  </div> 
  
  <div class="dropdown">
    <button class="dropbtn">Status Application 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="user_status_staff.php">Status for Staff</a>
      <a href="user_status.php">Status for Student</a>
     
    </div>
    
     
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Record Status Return
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="record_user_return_staff.php">Record Status Return(Staff)</a>
      <a href="record_user_return.php">Record StatusReturn(Student)</a>
     
    </div>
    </div>
     <div class="dropdown">
    <button class="dropbtn">Record Status Penalty
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="record_user_penalty_staff.php">Record Status Penalty(Staff)</a>
      <a href="record_user_penalty.php">Record Status Penalty(Student)</a>
     
    </div>
    </div>
 <li style="float:right"><a href="logout.php">Logout</a></li>
</div>
<div style="padding-left:16px"></div>
<div style="padding-left:20px">
  <center>
  
<h1></h1>
<center>
  <h2> RECORD RETURN OF SPORT EQUIPMENT(STUDENT)</h2>
</center>
<br></br>
<center><label></label>

<form action="" method="GET">

<input type="text" placeholder="Type here" name="search">&nbsp;

<input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">

</form></center>

 <p></p>
 
 
<table width="100%" border="1" style="border-collapse:collapse;">

<thead>
<tr>
  <th><strong>No</strong></th>
  <th><strong>Matric Number</strong></th>
  <th><strong>Approval_Date</strong></th>
  <th><strong>Return_Date </strong></th>
  <th><strong>Status</strong></th>
  
</thead>
<tbody>
<?php
$count=1;

mysql_select_db($database_db, $db);

$username = $_SESSION['username'];
$query_detail_approval_student_register = "SELECT * FROM users WHERE username = '$username'";
$detail_approval_student_register = mysql_query($query_detail_approval_student_register, $db) or die(mysql_error());
$row_detail_approval_student_register = mysql_fetch_assoc($detail_approval_student_register);
$totalRows_detail_approval_student_register = mysql_num_rows($detail_approval_student_register);

$userID = $row_detail_approval_student_register['userID'];


$sql = "SELECT * FROM application_student WHERE matric = '$userID'";


if( isset($_GET['search']) ){

    $matric = mysqli_real_escape_string($con, htmlspecialchars($_GET['search']));
	
$sql = "SELECT * FROM application_student WHERE matric LIKE '%$matric%' OR dateapproval LIKE '%$matric%'";


}

$result = $con->query($sql);

while($row = $result->fetch_assoc()) { ?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row['matric']; ?></td>
<td align="center"><?php echo $row['dateapproval']; ?></td>
<td align="center"><?php echo $row['return_date']; ?></td>
<td align="center"><?php echo $row['status_return']; ?></td>

<?php $count++; } ?>
</tbody>
</table>

<br /><br /><br /><br />

</div>




</body>
</html>
<body>


