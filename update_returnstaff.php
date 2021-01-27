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
<div style="padding-left:16px"></div>
<div style="padding-left:20px">
<br></br>
<br></br>
<?php

 
require('db.php');

$id=$_REQUEST['id'];
$query = "SELECT * from application_staff where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<center>
  <h1>Update Record Return of Sport Equipment(Staff)</h1></center>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$staffid =$_REQUEST['staffid'];
$approvaldate =$_REQUEST['approvaldate'];
$return_date =$_REQUEST['return_date'];
$status =$_REQUEST['status'];
$update="update application_staff set staffid='".$staffid."', approvaldate='".$approvaldate."',return_date='".$return_date."',status='".$status."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "Record Updated Successfully. </br></br><a href='record_user_return_staff.php'>View Updated Record Damage of Sport Equipment</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<center><form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
<p><input type="text" name="staffid" placeholder="StaffId" required value="<?php echo $row['staffid'];?>" style="opacity:0.5"readonly/></p>
<p><input type="text" name="approvaldate" placeholder="Approval Date" required value="<?php echo $row['approvaldate'];?>"style="opacity:0.5"readonly /></p>
<p><input type="text" name="return_date" placeholder="Return Date" required value="<?php echo $row['return_date'];?>"style="opacity:0.5"readonly /></p>
<select name="status" onchange="showUser(this.value)">
<option value=""></option>
<option value="Return">Return</option>
<option value="Pending">Pending</option>
<?php echo $row['status'];?>" /></select>

<p><input name="submit" type="submit" value="Update" /></p>
</form></center>
<?php } ?>

<br /><br /><br /><br />

</div>
</div>
</body>
</html>


</div></center>
</div>
</body>
</html>
