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
$query_staffdetail = "SELECT * FROM users WHERE username = '$username'";
$staffdetail = mysql_query($query_staffdetail, $db) or die(mysql_error());
$row_staffdetail = mysql_fetch_assoc($staffdetail);
$totalRows_staffdetail = mysql_num_rows($staffdetail);


mysql_select_db($database_db, $db);

$query_staff = "SELECT * FROM application_staff  ";
$staff = mysql_query($query_staff, $db) or die(mysql_error());
$row_staff = mysql_fetch_assoc($staff);
$totalRows_staff = mysql_num_rows($staff);
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
	if($row_staff['typeUser'] == "Staff"){
	?>
    <div class="dropdown-content">
      <a href="user_application_staff.php">Staff Application</a>
      <?php
	}
	else if($row_staff['typeUser'] == "Student"){
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
<p>&nbsp;</p>
  

 
</div>
<center>
<h1>FORM FOR BORROWING SPORT EQUIPMENT STAFF</h1></center>

<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="outer">
<div id="header">
<p>&nbsp;</p>
  <div id="menu"></div>
<div id="content">
  <div id="primaryContentContainer">
    <div id="primaryContent">
      
     <center> <form name="daftar_pelajar" id="daftar_pelajar" method="POST" onSubmit="return validateForm2()">
       <table width="1069" border="0">
         <tr>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td colspan="4"><p>&nbsp;</p>
             <p><strong>STAFF DETAIL</strong></p></td>
         </tr>
  <td width="41">&nbsp;</td>
    <td width="252">Name</td>
    <td width="352"><span id="sprytextfield1"><span class="textfieldRequiredMsg"></span></span></a><?php echo $row_staffdetail['username']; ?></td>
    <td width="112"><div id="txtHint1"></div></td>
    <td width="109">Email</td>
    <td width="164"><?php echo $row_staffdetail['email']; ?><span id="sprytextfield6"><span class="textfieldRequiredMsg"></span></span></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>I/C</td>
    <td><span id="sprytextfield2"><span class="textfieldRequiredMsg"></span></span></a><?php echo $row_staffdetail['ic']; ?></td>
    <td>&nbsp;</td>
    
    <td>Date</td>
    <td><?php echo $row_staff['date']; ?><span id="sprytextfield7"><span class="textfieldRequiredMsg"></span></span></a></td>
    
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>Staff Id</td>
    <td><span id="sprytextfield3">
      
    </span><span id="sprytextfield3"><span class="textfieldRequiredMsg"></span></span></a><?php echo $row_staff['staffid']; ?></td>
    <td>&nbsp;</td>
    
  <tr>
    <td>&nbsp;</td>
    <td>Department</td>
    <td><span id="sprytextfield4">
    
    </span><?php echo $row_staff['department']; ?><span id="sprytextfield4"><span class="textfieldRequiredMsg"></span></span></a></td>
    
    <td>&nbsp;</td>
    <td>Tel</td>
    <td><?php echo $row_staffdetail['tel']; ?><span id="sprytextfield12"><span class="textfieldRequiredMsg"></span></span></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Position</td>
    <td colspan="4"><?php echo $row_staff['position']; ?><span id="sprytextfield5"><span class="textfieldRequiredMsg"></span></span></a></td>
    
  </tr>
  <tr>
  <td>&nbsp;</td>
            <td>Address</td>
            <td><span id="sprytextfield8">
              
<span class="textfieldRequiredMsg"></span><?php echo $row_staffdetail['address']; ?></td></tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4"><p>&nbsp;</p>
      <p><strong>DETAIL EQUIPMENT</strong></p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Type of equipment</td>
    <td><span id="sprytextfield9">
    
    </span><?php echo $row_staff['type']; ?><span id="sprytextfield9"><span class="textfieldRequiredMsg"></span></span></a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Quantity</td>
    <td><?php echo $row_staff['quantity']; ?><span id="sprytextfield10"><span class="textfieldRequiredMsg"></span></span></a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Period of borrowing</td>
    <td><?php echo $row_staff['period']; ?><span id="sprytextfield11"><span class="textfieldRequiredMsg"></span></span></a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>Reason</p></td>
    <td colspan="8"><?php echo $row_staff['reason']; ?><span id="sprytextarea1"><span class="textareaRequiredMsg"></span></span> </a>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
  <tr>
                
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4"><p>&nbsp;</p>
            <p><strong>SPORTS EQUIPMENT BORROWING CONFIRMATION</strong></p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Status Approval</td>
            <td><span id="sprytextfield12">
             
              
            <span class="textfieldRequiredMsg"><?php echo $row_staff['approval']; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Date</td>
            <td>
             
              <?php echo $row_staff['approvaldate']; ?></td>
            <td>&nbsp;</td>
          <tr>
            <center>
            <td colspan="6" align="center">  </td></center>
          </tr>
          
            
           
            <script>
            var myVar = setInterval(function() {
  myTimer();
}, 1000);

function myTimer() {
  var d = new Date();
  document.getElementById("clock").innerHTML = d.toLocaleTimeString();
}
</script>
          </td>
          <tr>
            <td>&nbsp;</td>
            <td>Return Date</td>
            <td><span id="sprytextfield15"><?php echo $row_staff['return_date']; ?></td>
  <tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  <tr>
    <center>
      <td colspan="6" align="center"></td>
    </center>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="6"><label> </label>
      <div align="right">
        <p>&nbsp;</p>
      </div></td>
  </tr>
       </table>
       <center> 
      </form></center>
     <center> <button onclick="myFunction()">Print</button></center>
      
  <script>
function myFunction() {
    window.print();
}
</script>
    </div>
  </div>
  
  <div id="secondaryContent">
    <h3>&nbsp;</h3>
  </div>
</div>
<script type="text/javascript">
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
</script>
<?php
mysql_free_result($staffdetail);

mysql_free_result($staff);
?>
