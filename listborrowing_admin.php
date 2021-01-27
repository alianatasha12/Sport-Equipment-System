
<?php

require('db.php');

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #138D75;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
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

.dropdown-content a:hover {
  background-color: #4CAF50;
}

.dropdown:hover .dropdown-content {
  display: block;
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
<html>

<div class="navbar">
  <a href="admin_halaman.php">Home</a>
  <a href="insertdamage_admin.php">Damage of sport equipment</a>
  <a href="viewrecord_damage_admin.php">Record of damage</a>
  <div class="dropdown">
    <button class="dropbtn">List of borrowing 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="listborrowing_admin.php">List borrowing for student</a>
      <a href="listborrowing_admin_staff.php">List borrowing for staff</a>
      </div>
      </div>
   <div class="dropdown">
    <button class="dropbtn">Report 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="/chart.js/linegraph.html">Report quantity of borrowing</a>
      <a href="/chart.js/bargraph.html">Report of penalty</a>
   
    </div>
    </div> 
  <li style="float:right"><a href="logoutadmin.php">Logout</a></li>
</ul>  
</div>
</div>
<br></br>
<center><div>

<br></br>
<center>
  <h2> LIST OF SPORT EQUIPMENT BORROWING (STUDENT)</h2>
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
  
  <th><strong>Equipment Name</strong></th>
  <th><strong>Quantity</strong></th>
  <th><strong>Period</strong></th>
  <th><strong>Reason</strong></th>
  <th><strong>Approval_Date</strong></th>
  <th><strong>Return_Date </strong></th>
  <th><strong>Status</strong></th>
  <th><strong>Status_Return</strong></th>
   <th><strong>Penalty</strong></th>
    
  
</thead>
<tbody>
<?php
$count=1;


$sql = "SELECT * FROM application_student";

if( isset($_GET['search']) ){

    $matric = mysqli_real_escape_string($con, htmlspecialchars($_GET['search']));

    $sql = "SELECT * FROM application_student INNER JOIN users ON application_student.matric = users.userID WHERE application_student.matric LIKE '%$matric%' OR users.username LIKE '%$matric%'";

}

$result = $con->query($sql);

while($row = $result->fetch_assoc()) { ?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row['matric']; ?></td>

<td align="center"><?php echo $row['type']; ?></td>
<td align="center"><?php echo $row['quantity']; ?></td>
<td align="center"><?php echo $row['period']; ?></td>
<td align="center"><?php echo $row['reason']; ?></td>
<td align="center"><?php echo $row['dateapproval']; ?></td>
<td align="center"><?php echo $row['return_date']; ?></td>
<td align="center"><?php echo $row['approval']; ?></td>
<td align="center"><?php echo $row['approval']; ?></td>
<td align="center"><?php echo $row['penalty']; ?></td>

<?php $count++; } ?>
</tbody>
</table>

<br /><br /><br /><br />

</div>



</body>
</html>

<center><div>


</div></center>
</div>
</body>
</html>
