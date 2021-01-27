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
  <center>
  
<p></p>
<p>&nbsp;</p>
<h1><marquee style="border: #2E4053 2px SOLID;">Welcome to the Sport Equipment Borrowing System </marquee></h1>

  
</center>
<center></center>
<p>&nbsp;</p>




<h1></h1>
<h1></h1>
<div align = "center">
<div style = "width:700px; border: solid 1px #333333; " align = "left">
         
<div style = "background-color:#138D75; color:; padding:20px;"><center>
  <b>RULE OF BORROWING SPORT EQUIPMENTS</b>
</center></div>
<div style = "margin:70px">
  
  <form action = "" method = "post">
<center>
  <p>1) The borrower is fully responsible for the safety, loss and damage of equipment borrowed. </p>
  <p>2) All equipment borrowed MUST be refunded on a fixed date</p>
  <P>3) The borrowed equipment may NOT be transferred or borrowed to another person.</P>
  <P>4)Tthe borrower should report on the damage / loss of the equipment borrowed to the sports center at the time of its occurrence.</P>
  <p>5) Any lost equipment borrowed is under its sole responsibility and the borrower is required to replace the same sporting equipment.</p>
  <br /></center>
</form>
               
<div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
					
      </div>
				
    </div>
			
  </div>

<p>&nbsp;</p>

 
</div>
</body>
</html>
