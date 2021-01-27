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
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "daftar_pelajar")) {
  $insertSQL = sprintf("INSERT INTO application_student (matric, faculty, course, date, type, quantity, period, reason) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['text1'], "text"),
                       GetSQLValueString($_POST['text3'], "text"),
                       GetSQLValueString($_POST['text4'], "text"),
					   GetSQLValueString($_POST['text6'], "text"),					   
                       GetSQLValueString($_POST['text8'], "text"),
                       GetSQLValueString($_POST['text9'], "int"),
                       GetSQLValueString($_POST['text10'], "int"),
                       GetSQLValueString($_POST['textarea1'], "text"));

  mysql_select_db($database_db, $db);
  $Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

  $insertGoTo = "user_application.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_db, $db);

$username = $_SESSION['username'];

$query_registerlink = "SELECT * FROM users WHERE username = '$username'";
$registerlink = mysql_query($query_registerlink, $db) or die(mysql_error());
$row_registerlink = mysql_fetch_assoc($registerlink);
$totalRows_registerlink = mysql_num_rows($registerlink);

mysql_select_db($database_db, $db);

$query_studentapplication = "SELECT * FROM application_student ";
$studentapplication = mysql_query($query_studentapplication, $db) or die(mysql_error());
$row_studentapplication = mysql_fetch_assoc($studentapplication);
$totalRows_studentapplication = mysql_num_rows($studentapplication);
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
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
</script>
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
	if($row_registerlink['typeUser'] == "Staff"){
	?>
      <a href="user_application_staff.php">Staff Application</a>
   	<?php
	}
	else if($row_registerlink['typeUser'] == "Student"){
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
	if($row_registerlink['typeUser'] == "Staff"){
	?>
      <a href="user_status_staff.php">Status for Staff</a>
      <?php
	}
	else if($row_registerlink['typeUser'] == "Student"){
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
	if($row_registerlink['typeUser'] == "Staff"){
	?>
      <a href="record_user_return_staff.php">Record Status Return(Staff)</a>
       <?php
	}
	else if($row_registerlink['typeUser'] == "Student"){
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
	if($row_registerlink['typeUser'] == "Staff"){
	?>
      <a href="record_user_penalty_staff.php">Record Status Penalty(Staff)</a>
      <?php
	}
	else if($row_registerlink['typeUser'] == "Student"){
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

<div style="padding-left:16px">
<center>
<p>&nbsp;</p>
  

 
</div>
<center>
<h1>FORM FOR BORROWING SPORT EQUIPMENT STUDENT</h1></center>


<div id="outer">
<div id="header">

  <div id="menu"></div>
<div id="content">
  <div id="primaryContentContainer">
    <div id="primaryContent">
      
      <center><form action="<?php echo $editFormAction; ?>" name="daftar_pelajar" id="daftar_pelajar" method="POST" onSubmit="return validateForm2()">
        <table width="1069" border="0">
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4"><p>&nbsp;</p>
            <p><strong>STUDENT DETAIL</strong></p></td>
          </tr>
          <td width="41">&nbsp;</td>
            <td width="252">Name</td>
            <td width="352"><span id="sprytextfield1"><span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_registerlink['username']; ?></td>
            <td width="112"><div id="txtHint1"></div></td>
            <td width="109">Email</td>
            <td width="164"><label><span id="sprytextfield6"><span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_registerlink['email']; ?></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Matric number</td>
            <td><span id="sprytextfield2">
             <?php echo $row_registerlink['userID']; ?>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>Date</td>
            <td><span id="sprytextfield7">
              <input type="date" name="text6" id="date">
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>I/C</td>
            <td><span id="sprytextfield3"><span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_registerlink['ic']; ?></td>
            <td>&nbsp;</td>
            
          <tr>
            <td>&nbsp;</td>
            <td>Faculty</td>
            <td><span id="sprytextfield4">
              <input type="text" name="text3" id="faculty">
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            
            <td>&nbsp;</td>
            <td>Tel</td>
            <td><span id="sprytextfield12"><span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_registerlink['tel']; ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Course</td>
            <td colspan="4"><span id="sprytextfield5">
              <input type="text" name="text4" id="course">
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Address</td>
            <td colspan="4"><span id="sprytextfield5">
             
            <span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_registerlink['address']; ?></td>
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
                <input type="text" name="text8" id="type_equipment">
                <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Quantity</td>
            <td><span id="sprytextfield10">
              <input type="text" name="text9" id="quantity">
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            
            
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Period of borrowing</td>
            <td><span id="sprytextfield11">
              <input type="text" name="text10" id="period">
              <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            
            
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><p>Reason</p></td>
            <td colspan="8"><span id="sprytextarea1">
              <textarea name="textarea1" id="reason" cols="45" rows="5"></textarea>
              <span class="textareaRequiredMsg"><A value is required.</span></span>
         
            <center>
            <td colspan="6" align="center">  </td></center>
          </tr>
            
          
              
              
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          
          <tr>
            <td colspan="6"><label> </label>
              <div align="right">
              <center><input name="Submit" type="submit" onClick="MM_popupMsg('Successfully submit!')" value="Submit"></center>

              

               
               

            </div></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="daftar_pelajar">
<center> </form></center>

     
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
</script>
<?php
mysql_free_result($registerlink);

mysql_free_result($studentapplication);
?>
