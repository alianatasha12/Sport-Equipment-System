<?php require_once('Connections/db.php'); ?>
<?php
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
$query_recordregister = "SELECT * FROM users";
$recordregister = mysql_query($query_recordregister, $db) or die(mysql_error());
$row_recordregister = mysql_fetch_assoc($recordregister);
$totalRows_recordregister = mysql_num_rows($recordregister);

mysql_select_db($database_db, $db);
$query_record_applicationstudent = "SELECT * FROM application_student";
$record_applicationstudent = mysql_query($query_record_applicationstudent, $db) or die(mysql_error());
$row_record_applicationstudent = mysql_fetch_assoc($record_applicationstudent);
$totalRows_record_applicationstudent = mysql_num_rows($record_applicationstudent);
?>
<?php

require('db.php');

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
  <a href="staff_halaman.php" class="active">Home</a>
  
    <div class="dropdown">
    <button class="dropbtn">Status Approval
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="status_staffapproval_student.php">Student status</a>
      <a href="status_staffapproval_staff.php">Staff status</a>
     
    </div>
    
  </div> 
  
    <div class="dropdown">
    <button class="dropbtn">Status Return
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="record_status_return_penalty_student.php">Status Return Student</a>
      <a href="record_status_return_penalty_staff.php">Status Return Staff</a>
     
    </div>
     <div class="dropdown">
    <button class="dropbtn">Status Penalty
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="">Status Penalty Student</a>
      <a href="status_staff_penaltystaff.php">Status Penalty Staff</a>
     
    </div>
    
  </div> 
    </div> 
 <li style="float:right"><a href="logoutstaff.php">Logout</a></li>
</div>
<body>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <center><input type="search" id="site-search" name="q"
       aria-label="Search through site content">
        <button>Search</button></center>
        <p></p>
         <p></p>
<center><table width="1374" border="1">
        <tr>
          <td width="1349" height="62"align="center" valign="middle"bgcolor="#00FFFF">RECORD STATUS FOR RETURN&PENALTY</td>
    </tr>
  </table>
  <table width="1373" border="1">
    <tr>
      <td width="286" height="71"align="center" valign="middle"bgcolor="#00FFFF">NAMA</td>
      <td width="130" height="71"align="center" valign="middle"bgcolor="#00FFFF">IC</td>
      <td width="142" height="71"align="center" valign="middle"bgcolor="#00FFFF">ADDRESS</td>
      <td width="137" height="71"align="center" valign="middle"bgcolor="#00FFFF">EMAIL</td>
      <td width="193" height="71"align="center" valign="middle"bgcolor="#00FFFF">PHONE NUMBER</td>
      <td width="132" height="71"align="center" valign="middle"bgcolor="#00FFFF">APPROVAL STATUS</td>
      <td width="162" height="71"align="center" valign="middle"bgcolor="#00FFFF">APPROVAL DATE</td>
      <td width="162" height="71"align="center" valign="middle"bgcolor="#00FFFF">RETURN DATE</td>
      <td width="162" height="71"align="center" valign="middle"bgcolor="#00FFFF">PENALTY</td>
      <td width="162" height="71"align="center" valign="middle"bgcolor="#00FFFF">DELETE</td>
    </tr>
    <?php do { ?>
    <tr>
      <td height="60"  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_recordregister['username']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_recordregister['ic']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_recordregister['address']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_recordregister['email']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_recordregister['tel']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_record_applicationstudent['approval']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_record_applicationstudent['dateapproval']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><?php echo $row_record_applicationstudent['return_date']; ?></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><a href="">PENALTY</a></td>
      <td  align="center" valign="middle" bgcolor="#E0FFFF"><a href="delete_record_status_return_penalty_student.php?<?php echo $row_recordregister['id']; ?>=<?php echo $row_recordregister['id']; ?>&<?php echo $row_record_applicationstudent['id']; ?>=<?php echo $row_record_applicationstudent['id']; ?>">DELETE</a></td>
    </tr>
    
    </tr>
  <?php } while ($row_recordregister = mysql_fetch_assoc($recordregister)); ?>
  </table>
<p>&nbsp;</p>
  <p>&nbsp;</p>
</center>


<?php
mysql_free_result($recordregister);

mysql_free_result($record_applicationstudent);
?>
