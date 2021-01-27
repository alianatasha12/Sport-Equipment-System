
<?php

 
require('db.php');



if(isset($_POST['login'])){
    
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sel_username = "select * from adminlogin where username='$username' AND password='$password'";
    
    $run_username = mysqli_query($con, $sel_username);
    
    $check_username = mysqli_num_rows($run_username);
    

if($check_username==1){
        
        $_SESSION['username']=$username;
        echo "<script>alert('You successfully login !')</script>";
    
    echo "<script>window.open('admin_halaman.php?logged_in=You Successfully Logged in!','_self')</script>";
    
    }
    else {
        echo "<script>alert('Username or Password is incorrect, try again')</script>";
    
        
    }
}

?>


<title>Admin Login</title>
<body bgcolor = "#FFFFFF">
<center></center>
<div style = "background-color:#138D75; color:#; padding:10px;"> <center><h2>SPORT EQUIPMENT BORROWING SYSTEM </h2>
</center></div>
<h2>
</h2><h2>
 <center><h2><img src="admin.png" width="160" height="160" alt="admin"></h2></center>
 <h2>

<center>
  <h2>ADMINISTRATOR</h2></center>
<h2></h2>
<div align = "center">
<div style = "width:450px; border: solid 1px #333333; " align = "left">
         
<div style = "background-color:#138D75; color:#FFFFFF; padding:20px;"><center><b>LOGIN </b></center></div>
<div style = "margin:30px">
  
  <form action = "" method = "post">
<center><label>Admin  :</label>    
  <input type = "text" name = "username" class = "box"/><br /><br /></center>
<center><label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
<input name="login" type="submit" value="submit"><br /></center>
</form>
               
<div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
					
          </div>
				
         </div>
			
      </div>

   </body>
</html>