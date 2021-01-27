<?php require_once('Connections/db.php'); ?>
<?php
session_start();
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_db, $db);
$username = $_SESSION['username'];

$query_student_status = "SELECT * FROM users WHERE username = '$username'";
$student_status = mysql_query($query_student_status, $db) or die(mysql_error());
$row_student_status = mysql_fetch_assoc($student_status);
$totalRows_student_status = mysql_num_rows($student_status);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <?php
	if($row_student_status['typeUser'] == "Staff"){
	?>
      <a href="user_application_staff.php">Staff Application</a>
      	<?php
	}
	else if($row_student_status['typeUser'] == "Student"){
	?>
      <a href="user_application.php">Student Application</a>
     <?php
	}
	?>
    </div>
    
  </div> 
  
  <div class="dropdown">
    <button class="dropbtn">Status Application 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
     <?php
	if($row_student_status['typeUser'] == "Staff"){
	?>
      <a href="user_status_staff.php">Status for Staff</a>
      <?php
	}
	else if($row_student_status['typeUser'] == "Student"){
	?>
      <a href="user_status.php">Status for Student</a>
      <?php
	}
	?>
    </div>
    
  </div> 
   <div class="dropdown">
    <button class="dropbtn">Record Status Return
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <?php
	if($row_student_status['typeUser'] == "Staff"){
	?>
      <a href="record_user_return_staff.php">Record Status Return(Staff)</a>
       <?php
	}
	else if($row_student_status['typeUser'] == "Student"){
	?>
      <a href="record_user_return.php">Record StatusReturn(Student)</a>
     <?php
	}
	?>
    </div>
    </div>
     <div class="dropdown">
    <button class="dropbtn">Record Status Penalty
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <?php
	if($row_student_status['typeUser'] == "Staff"){
	?>
      <a href="record_user_penalty_staff.php">Record Status Penalty(Staff)</a>
      <?php
	}
	else if($row_student_status['typeUser'] == "Student"){
	?>
      <a href="record_user_penalty.php">Record Status Penalty(Student)</a>
     <?php
	}
	?>
    </div>
    </div>
 <li style="float:right"><a href="logout.php">Logout</a></li>
</div>
</div>
</div>

<div style="padding-left:16px">
<center>
<p>&nbsp;</p>
  
<p>&nbsp;</p>
</center>
<p>&nbsp;</p>
 
</div>

<div style="padding-left:16px">
<center>


</center>
<center></center>
<p>&nbsp;</p>
 
</div>
<h1></h1>
<h1></h1>

    <p></p>
    <center>
      <h1>STATUS BORROWING AND RETURN FOR STUDENT</h1></center>
 
    <p>&nbsp;</p>
    <center><table width="884" border="1">
  <tr>
    <td width="179" height="67"align="center" valign="middle"bgcolor="#DCDCDC">IC</td>
    <td width="429"align="center" valign="middle"bgcolor="#DCDCDC">NAME</td>
    <td width="254"align="center" valign="middle"bgcolor="#DCDCDC">CHECK</td>
  </tr>
  
  <tr>
    <td height="66"align="center" valign="middle"bgcolor="#F8E0F7"><?php echo $row_student_status['ic']; ?></td>
      <td height="66"align="center" valign="middle"bgcolor="#F8E0F7"><?php echo $row_student_status['username']; ?></td>
    <td  align="center" valign="middle" bgcolor="#F8E0F7"><a href="student_approvalstatus.php">DETAILS</a> </td>
  </tr>
   
    </table></center>

    <p>
<div class="container">
    </p>
    <div class="row">
        <div class="main-slider">
<div class="slide-text">
<?php
mysql_free_result($student_status);
?>
