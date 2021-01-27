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

$editFormAction = $_SERVER['PHP_SELF'];
/*if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}*/

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "daftar_pelajar")) {
	$userID = $_GET['userID'];
  $insertSQL = sprintf("UPDATE application_student SET approval = %s , dateapproval = %s, return_date = %s WHERE matric = '$userID'",
                       GetSQLValueString($_POST['approval'], "text"),
                       GetSQLValueString($_POST['text11'], "date"),
                       GetSQLValueString($_POST['text13'], "date"));

  mysql_select_db($database_db, $db);
  $Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

  $insertGoTo = "status_application_student.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "daftar_pelajar")) {
	$userID = $_GET['userID'];
  $insertSQL = sprintf("UPDATE application_student SET approval = %s , dateapproval = %s, return_date = %s WHERE matric = '$userID'",
                       GetSQLValueString($_POST['approval'], "text"),
                       GetSQLValueString($_POST['text11'], "date"),
                       GetSQLValueString($_POST['text13'], "date"));

  mysql_select_db($database_db, $db);
  $Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

  $insertGoTo = "status_application_student.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_db, $db);

mysql_select_db($database_db, $db);
$username = $_SESSION['username'];
$userID = $_GET['matric'];

$query_detail_approval_student_register = "SELECT * FROM users WHERE userID = '$userID' ";
$detail_approval_student_register = mysql_query($query_detail_approval_student_register, $db) or die(mysql_error());
$row_detail_approval_student_register = mysql_fetch_assoc($detail_approval_student_register);
$totalRows_detail_approval_student_register = mysql_num_rows($detail_approval_student_register);

$userID = $row_detail_approval_student_register['userID'];

$query_detail_approval_student = "SELECT * FROM application_student WHERE matric = '$userID'";
$detail_approval_student = mysql_query($query_detail_approval_student, $db) or die(mysql_error());
$row_detail_approval_student = mysql_fetch_assoc($detail_approval_student);
$totalRows_detail_approval_student = mysql_num_rows($detail_approval_student);

mysql_select_db($database_db, $db);
$query_staff_approve = "SELECT approval, dateapproval, return_date FROM application_student WHERE matric = '$userID'";
$staff_approve = mysql_query($query_staff_approve, $db) or die(mysql_error());
$row_staff_approve = mysql_fetch_assoc($staff_approve);
$totalRows_staff_approve = mysql_num_rows($staff_approve);
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
      <a href="status_staff_returnstudent.php">Status Return Student</a>
      <a href="status_staff_returnstaff.php">Status Return Staff</a>
     
    </div>
  </div>
  

    
   
     
  
<li style="float:right"><a href="logoutstaff.php">Logout</a></li>
</div>
</div>

<div style="padding-left:16px"></div>
<div style="padding-left:20px">


<center>
<h1>FORM FOR BORROWING SPORT EQUIPMENT STUDENT</h1></center>

<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="outer">
<div id="header">
<p>&nbsp;</p>
  <div id="menu"></div>
<div id="content">
  <div id="primaryContentContainer">
    <div id="primaryContent">
      
      <center><form action="<?php echo $editFormAction."?userID=".$row_detail_approval_student['matric']; ?>" name="daftar_pelajar" id="daftar_pelajar" method="POST" onSubmit="return validateForm2()">
        <table width="1069" border="0">
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4"><p>&nbsp;</p>
            <p><strong>STUDENT DETAIL</strong></p></td>
          </tr>
          <td width="41">&nbsp;</td>
            <td width="252">Name</td>
            <td width="352"><span id="sprytextfield1">
            
               <span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_detail_approval_student_register['username']; ?></td>
            <td width="112"><div id="txtHint1"></div></td>
            <td width="109">Email</td>
            <td width="164"><label><span id="sprytextfield6"><span class="textfieldRequiredMsg"><A value is required.</span></span></label><?php echo $row_detail_approval_student_register['email']; ?></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Matric number</td>
            <td><span id="sprytextfield2">
               <?php echo $row_detail_approval_student['matric']; ?> 
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>Date</td>
            <td><span id="sprytextfield7"><?php echo $row_detail_approval_student['date']; ?>
            
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>I/C</td>
            <td><span id="sprytextfield3"><span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_detail_approval_student_register['ic']; ?></td>
            
          <tr>
            <td>&nbsp;</td>
            <td>Faculty</td>
            <td><span id="sprytextfield4">
              <?php echo $row_detail_approval_student['faculty']; ?> 
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            
            <td>&nbsp;</td>
            <td>Tel</td>
            <td><span id="sprytextfield16"><span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_detail_approval_student_register['tel']; ?></td>
          </tr>
          <tr>
           
            <td>&nbsp;</td>
            <td>Address</td>
            <td><span id="sprytextfield16"><span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_detail_approval_student_register['address']; ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Course</td>
            <td colspan="4"><span id="sprytextfield5">
              <?php echo $row_detail_approval_student['course']; ?> 
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
          </tr>
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
                <?php echo $row_detail_approval_student['type']; ?> 
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Quantity</td>
            <td><span id="sprytextfield10">
              <?php echo $row_detail_approval_student['quantity']; ?> 
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            
            
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Period of borrowing</td>
            <td><span id="sprytextfield11">
              <?php echo $row_detail_approval_student['period']; ?> 
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            
            
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><p>Reason</p></td>
            <td colspan="8"><span id="sprytextarea1">
              <?php echo $row_detail_approval_student['reason']; ?> 
              <span class="textareaRequiredMsg"><A value is required.</span></span>
          <tr>
                
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4"><p>&nbsp;</p>
            <p><strong>SPORT EQUIPMENT BORROWING CONFIRMATION</strong></p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Status Approval</td>
            <td><span id="sprytextfield12">
             <select name="approval" onchange="showUser(this.value)">
<option value=""></option>
<option value="approve">Approve</option>
<option value="pending">Pending</option>
</select>
              
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Date</td>
            <td>
              <input type="date" name="text11" id="date">
           </td>
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
            <td><span id="sprytextfield15">
              <input type="date" name="text13" id="return_date">
             </td>
              
              
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="8">&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
             <td>&nbsp;</td>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="8"></td>
          </tr>
          
          
          </tr>
          
          </tr>
          <tr>
            <td colspan="6"><label> </label>
              <div align="right">
               <center><input name="Submit" type="submit" onClick="MM_popupMsg('Successfully submit!')"  value="Submit"></center>
                <p>&nbsp;</p>
            </div></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="daftar_pelajar">
<center> </form></center>
      
      
  
    </center></div>
  </div>
  
  <div id="secondaryContent">
    <h3>&nbsp;</h3>
  </div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
</script>
<?php
mysql_free_result($detail_approval_student);

mysql_free_result($detail_approval_student_register);

mysql_free_result($staff_approve);
?>
