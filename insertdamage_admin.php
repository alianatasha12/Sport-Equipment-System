

<?php

 
require('db.php');



$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$trn_date = date("Y-m-d H:i:s");
$name =$_REQUEST['name'];
$series = $_REQUEST['series'];
$total = $_REQUEST['total'];

$ins_query="insert into new_record (`trn_date`,`name`,`series`,`total`) values ('$trn_date','$name','$series','$total')";
mysqli_query($con,$ins_query) or die(mysql_error());
$status = "New Record Inserted Successfully.</br></br><a href='viewrecord_damage_admin.php'>View Inserted Record</a>";
}
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
</style>
</head>
<body>

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
    </div> 
    
</div>


</body>
</html>
<br></br>
<center><div>
<h1>Insert New Record Damage of Sport Equipment</h1>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<p><input type="text" name="name" placeholder="Enter name of equipment" required /></p>
<p><select name="series" onchange="showUser(this.value)">
<option value=""></option>
<option value="bs1">Bola Sepak(bs1)</option>
<option value="kh43">Kayu Hoki(kh43)</option>
<option value="BJ145">Bola Jaring(BJ145)</option>
<option value="BB67">BasketBall(BB67)</option>
<option value="BM56">Raket(BM56)</option>
<option value="RT345">Raket Tennis(RT345)</option>
<option value="BR189">Bola Rugby(BR189)</option>
<option value="BPQ45">Bola Petanque(BPQ45)</option>
<option value="TBJ64">Tiang bola jaring(TBJ64)</option>
<option value="GBB">Gol bola jaring(GBB)</option>
<option value="STS12">Sarung tangan softball(STS12)</option>
<option value="BTW12">Bola Takraw(BTW34)</option>
</select></p>
<p><input type="text" name="total" placeholder="Enter total damage" required /></p>




<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#FF0000;"><?php echo $status; ?></p>

<br /><br /><br /><br />

</div></center>
</div>
</body>
</html>
