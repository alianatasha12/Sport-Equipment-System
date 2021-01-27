<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$userid = stripslashes($_REQUEST['userID']);
		$userid = mysqli_real_escape_string($con,$userid);
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$ic = stripslashes($_REQUEST['ic']);
		$ic = mysqli_real_escape_string($con,$ic);
		$tel = stripslashes($_REQUEST['tel']);
		$tel = mysqli_real_escape_string($con,$tel);
		$typeUser = ucfirst(stripslashes($_REQUEST['typeUser']));
		$typeUser = mysqli_real_escape_string($con,$typeUser);
        $address = stripslashes($_REQUEST['address']);
		$address = mysqli_real_escape_string($con,$address);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (userID, username, email,ic,tel,typeUser,address, password,  trn_date) 
		VALUES ('$userid', '$username', '$email','$ic','$tel','$typeUser','$address','".md5($password)."',  '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
		else {
			echo '<script language="javascript">alert("Sorry! We have a problem. Please try again.")</script>';
			die(mysqli_error());
		}
    }else{
?>


<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Name" required />
<input type="text" name="userID" placeholder="ID Number (Staff ID / Matric ID)" required />
<input type="email" name="email" placeholder="Email" required />

 <input type="text"  class="form-control" id="ic" name="ic" placeholder="IC" pattern="[0-9]{12,12}" maxlength="12"
         oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'Nombor sahaja, tanpa simbol (-) dan maksima 12 nombor sahaja.');" required>
         <span id="availability"></span>
         
<input type="text"  class="form-control" id="tel" name="tel" placeholder="Phone Number" pattern="[0-9]{12,12}" maxlength="10"
oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' :'Masukkan nombor sahaja.');" required>
<span id="availability"></span>

<input type="typeUser" name="typeUser" placeholder="Type User:(student/staff)" required />

<input type="address" name="address" placeholder="Address" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />

</div>
<?php } ?>
</body>
</html>
