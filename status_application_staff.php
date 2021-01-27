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
	$userID=$_GET['staffid'];
  $insertSQL = sprintf("UPDATE application_staff SET approvaldate=%s, return_date=%s, approval=%s WHERE staffid = '$userID'",
                       
              GetSQLValueString($_POST['date'], "date"),
              GetSQLValueString($_POST['return_date'], "date"),
              GetSQLValueString($_POST['approval'], "text"));

  mysql_select_db($database_db, $db);
  $Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

  $insertGoTo = "status_application_staff.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_db, $db);
$username = $_SESSION['username'];
$userID = $_GET['staffid'];

$query_approval_detailstaff_staff_register = "SELECT * FROM users WHERE userID = '$userID'";
$approval_detailstaff_staff_register = mysql_query($query_approval_detailstaff_staff_register, $db) or die(mysql_error());
$row_approval_detailstaff_staff_register = mysql_fetch_assoc($approval_detailstaff_staff_register);
$totalRows_approval_detailstaff_staff_register = mysql_num_rows($approval_detailstaff_staff_register);

mysql_select_db($database_db, $db);
$query_approval_detail_staff = "SELECT * FROM application_staff WHERE staffid='$userID'";
$approval_detail_staff = mysql_query($query_approval_detail_staff, $db) or die(mysql_error());
$row_approval_detail_staff = mysql_fetch_assoc($approval_detail_staff);
$totalRows_approval_detail_staff = mysql_num_rows($approval_detail_staff);

mysql_select_db($database_db, $db);
$query_confirm_staff = "SELECT approvaldate, return_date, status FROM application_staff WHERE staffid='$userID'";
$confirm_staff = mysql_query($query_confirm_staff, $db) or die(mysql_error());
$row_confirm_staff = mysql_fetch_assoc($confirm_staff);
$totalRows_confirm_staff = mysql_num_rows($confirm_staff);
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

 
 
</div>
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
      
      <center><form action="<?php echo $editFormAction."?staffid=".$row_approval_detail_staff['staffid']; ?>" name="daftar_pelajar" id="daftar_pelajar" method="POST" onSubmit="return validateForm2()">
        <table width="1069" border="0">
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4"><p>&nbsp;</p>
            <p><strong>STAFF DETAIL</strong></p></td>
          </tr>
          <td width="41">&nbsp;</td>
            <td width="252">Name</td>
            <td width="352"><span id="sprytextfield1"><?php echo $row_approval_detailstaff_staff_register['username']; ?>
             
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td width="112"><div id="txtHint1"></div></td>
            <td width="109">Email</td>
            <td width="164"><span id="sprytextfield6">
             <?php echo $row_approval_detailstaff_staff_register['email']; ?>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>I/C</td>
            <td><span id="sprytextfield2">
            <?php echo $row_approval_detailstaff_staff_register['ic']; ?>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>Date</td>
            <td><span id="sprytextfield7">
         
            <span class="textfieldRequiredMsg"><A value is required.</span></span><?php echo $row_approval_detail_staff['date']; ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Staff Id</td>
            <td><span id="sprytextfield3"><?php echo $row_approval_detail_staff['staffid']; ?>
            
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
           
          <tr>
            <td>&nbsp;</td>
            <td>Department</td>
            <td><span id="sprytextfield4">
             <?php echo $row_approval_detail_staff['department']; ?>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            
            <td>&nbsp;</td>
            <td>Tel</td>
            <td><span id="sprytextfield15">
               <?php echo $row_approval_detailstaff_staff_register['tel']; ?>
              <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Position</td>
            <td colspan="4"><span id="sprytextfield5">
              <?php echo $row_approval_detail_staff['position']; ?>
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
            <?php echo $row_approval_detail_staff['type']; ?>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Quantity</td>
            <td><span id="sprytextfield10">
              <?php echo $row_approval_detail_staff['quantity']; ?>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            
            
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Period of borrowing</td>
            <td><span id="sprytextfield11">
             <?php echo $row_approval_detail_staff['period']; ?>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            
            
            
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><p>Reason</p></td>
            <td colspan="8"><span id="sprytextarea1">
            <?php echo $row_approval_detail_staff['reason']; ?>
                <span class="textareaRequiredMsg"><A value is required.</span></span>
          <tr>
                
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4"><p>&nbsp;</p>
            <p><strong>SPORT EQUIPMENT BORROWING CONFIRMATION</strong></p></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Status</td>
            <td><span id="sprytextfield12">
            <select name="approval" onchange="showUser(this.value)">
<option value=""></option>
<option value="Approve">Approve</option>
<option value="Pending">Pending</option>
</select>
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Date</td>
            <td><span id="sprytextfield13">
              <input type="date" name="date" id="approvaldate">
            <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
            <td>&nbsp;</td>
          <tr>
            <center>
            <td colspan="6" align="center">  </td></center>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>Return Date</td>
           <td><span id="sprytextfield15">
              <input type="date" name="return_date" id="return_date">
              <span class="textfieldRequiredMsg"><A value is required.</span></span></td>
              
              
              
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="8">&nbsp;</td>
          </tr>
         
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="8"></td>
          
          
          </tr>
          <tr>
            <td colspan="6"><label> </label>
              <div align="right">
                <p>&nbsp;</p>
                <center><input name="Submit" type="submit" onClick="MM_popupMsg('Successfully submit!')"  value="Submit"></center>
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
</script>
<?php
mysql_free_result($approval_detailstaff_staff_register);

mysql_free_result($approval_detail_staff);

mysql_free_result($confirm_staff);
?>
