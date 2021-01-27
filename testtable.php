<!DOCTYPE html>
<html>
<head>
<style>
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
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>HTML Table</h2>
<?php
$count=1;
$sel_query="Select * from new_record ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<table>
  <tr>
    <th>NO</th>
    <th>NAME</th>
    <th>SERIES</th>
    <th>TOTAL</th>
    <th>DATE</th>
    <th>EDIT</th>
    <th>DELETE</th>
  </tr>
 <tr>
    <td><?php echo $count; ?></td>
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["series"]; ?></td>
     <td><?php echo $row["total"]; ?></td>
      <td><?php echo $row["trn_date"]; ?></td>
       <td><a href="edit_record_damage_admin.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
        <td><a href="delete_recorddamage_admin.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
  </tr> 
</table>
<?php $count++; } ?>
</tbody>
</table>
</body>
</html>