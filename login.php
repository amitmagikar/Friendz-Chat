<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Friendz Chat - Log in</title>		
		<link rel="stylesheet" type="text/css" href="style.css">		
		<script src="script.js"></script>			
	</head>
	
	<body style="background-image:url("background.jpg");background-repeat:no-repeat;background-size:100%;">
		<form name="form3" action="login.php" method="post">		
			<div class="login_title">	
				<h3 align="center">Friendz Chat</h3>			
				<h4 align="center">Sign In</h4>		
			</div>
		
		    <div class="login-box">
			<div class="login-username-label">
			Username:
			</div>
			<div class="login-username-text">						
			<input type="text" name="username">
			</div>	
			
			<div class="login-password-label">		
			Password:
			</div>
			<div class="login-password-text">							
			<input type="password" name="password">
			</div>	
					
			<div class="login-button">
			<input type="submit" name="login" value="Login" style="height:40px; width:80px;">	
			</div>
			</div>	
			
		    <div class="register-link">	
			<!-- For a new user visiting for the first time, application registration link -->		
				<p align="center">Don't have an Account? Click <a href="register.php">here</a> to Sign Up!! </p>
			</div>
		</form>
	</body>
</html>


<?php
	if(isset($_POST['login'])){
		$con=mysqli_connect("localhost","root","root","chat");		
		if(!$con){
			die("Connection Failed!!!".mysqli_connect_error());		
		}

		$username=$_POST['username'];
		$password=$_POST['password'];

	    //Check if the username and password exists in the database table
		$result5=mysqli_query($con, "SELECT * FROM login_details WHERE username='$username' AND password='$password' ");	
		
		if(mysqli_num_rows($result5)==1){
			while($row5=mysqli_fetch_array($result5)){
				$firstName=$row5['firstName'];
				$lastName=$row5['lastName'];
			}
			//If the username exists and password is correct then start the session for that particular user
			session_start();			
			$_SESSION['username']=$username;
			$_SESSION['userFirstName']=$firstName;
			$_SESSION['userLastName']=$lastName;
?>
			<br/>
			<!-- Redirect the validated user to his/her homepage i.e. home.php -->
			<script>window.location="home.php"</script>		
			<?php 	
		}	//end of if statement
		else{
			?> 
			<!-- If validation fails then display appropriate message to the user -->
			<script>alert("Username or password does not match!!!");</script>		
			<?php 
		}
    	mysqli_close($con);		
	}
	
              ?>	