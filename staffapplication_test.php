<!DOCTYPE html>
<html>
<head>
<title>PHP insertion</title>
<link href="css/insert.css" rel="stylesheet">
</head>
<body>
<div class="maindiv">
<!--HTML Form -->
<div class="form_div">
<div class="title">
<h2>Insert Data In Database Using PHP.</h2>
</div>
<form action="php_applicationstaff.php" method="post">
<!-- Method can be set as POST for hiding values in URL-->
<h2>Form</h2>
<label>Name:</label>
<input class="input" name="staffid" type="text" value="">
<label>Email:</label>
<input class="input" name="department" type="text" value="">
<label>Contact:</label>
<input class="input" name="position" type="text" value="">
<label>Address:</label>
<textarea cols="25" name="date" rows="5"></textarea><br>
<input class="submit" name="submit" type="submit" value="Insert">
</form>
</div>
</div>
</body>
</html>