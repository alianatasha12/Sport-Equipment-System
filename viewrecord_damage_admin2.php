 <!DOCTYPE html>
<html>
<head>
<style>
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
</style>
</head>
<body>

<ul>
  <li><a class="active" href="admin_halaman.php">Home</a></li>
  <li><a href="insertdamage_admin.php">Damage of sport equipment</a></li>
  <li><a href="viewrecord_damage_admin.php">Report of damage</a></li>
   <li><a href="#contact">Report of status borrowing</a></li>
 <li style="float:right"><a href="logoutadmin.php">Logout</a></li>
 </ul>
<br></br>
<body>
 
 
 <?php
$db="simple";
$searchtype=$_POST['searchtype'];
$searchvalue=$_POST['searchvalue'];

mysql_connect("localhost","root","")or die("Could not connect to server.".mysql_error());
mysql_select_db("simple")or die("Could not connect to database".mysql_error());

$query="SELECT * FROM new_record WHERE $searchtype LIKE '$searchvalue'";
$result=mysql_query($query);
$num_rows=mysql_num_rows($result);

if($num_rows < 1)
{

echo "<h3 align='center'>No Record Found</h3>";
}
else
{

echo "<h4 style='color:#795e4b;text-align:center'>Record Found</h4>";
echo "<h4 style='color:#000;text-align:center'>There are <u>$num_rows</u> records.</h4><p>";
echo "<table border='3' width='1000' bgcolor='#fff' align='center'>";
echo "<tr>";
echo "<tr bgcolor='LightGreen'>";
echo "<th>id</th>";
echo "<th><b>date&time</b></th>";
echo"<th><b>name</b></th>";
echo"<th><b>series</b></th>";

echo"<th><b>total</b></th>";
echo "</tr>";





while($get_info = mysql_fetch_row($result))
{
echo "<tr>";

foreach ($get_info as $field)
{
echo "<td align='center'>$field</td>";
}
echo "</tr>";
}
echo "</table>";
}
?>