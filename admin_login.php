<?php
session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Login </title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"  href="css/admin_login.css">

</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form method="POST" action="admin_login_backend.php">
				<img src="img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="admin_name" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="admin_password" class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<!-- <input type="submit" name="login" class="btn" value="Login"> -->
				<button type="submit"  name="Login" class="btn" >Login</button>
            </form>
        </div>
    </div>
	<?php
	
	if(isset($_POST['Login'])){

		echo "hello";
		

		$query="SELECT * FROM `admin_login` WHERE `admin_name`=`$_POST[admin_name]` AND `admin_password`=`$_POST`[admin_password] ";
		$result=mysqli_query($con,$query);
		if(mysqli_num_rows($result)==1){
			echo "correct";
		}
		else{
			echo "incorrect";
		}
	}
	
	?>

    <script type="text/javascript" src="js/admin.js"></script>
</body>
</html>