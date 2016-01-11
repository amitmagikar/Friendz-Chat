<html>
	<head>
		<title>Friendz Chat - Register</title>			
		<link rel="stylesheet" type="text/css" href="style.css">		 
	</head>
	
	<body>
		<form name="form1" action="register.php" method="post">		
			<div class="register_title">
				<h3 align="center">Friendz Chat</h3>			
				<h4 align="center">Sign Up</h4>
			</div>
			
			
				<div class="register-box">
					<div class="firstname-label">
					First Name:
					</div>

					<div class="firstname-text">								
					<input type="text" name="firstname">
					</div>
				
					<div class="lastname-label">
					Last Name:
					</div>

					<div class="lastname-text">								
					<input type="text" name="lastname">	
				    </div>
			
				    <div class="username-label">
				    Username:
				    </div>

				    <div class="username-text">								
					<input type="text" name="username">
                    </div> 
				
					<div class="password-label">
					Password:
					</div>

					<div class="password-text">									
					<input type="password" name="password">	
				    </div>
			
				    <div class="password-label2">
					Re-Enter Password:
					</div>

					<div class="password-text2">							
					<input type="password" name="password2">	
				    </div>
			
				    <div class="create-account">
					<input type="submit" name="register" value="Create Account" style="height:40px; width:120px;">
					</div>		
			</div>
			
		</form>
	</body>
</html>

<?php
	if(isset($_POST['register'])){
		$con=mysqli_connect("localhost","root","root","chat");		
		if(!$con){
			die("Connection Failed!!!".mysqli_connect_error());		
		}

		$firstName=$_POST['firstname'];
		$lastName=$_POST['lastname'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
	
	    //If any of the fields are empty, display appropriate message to the user
		if(empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($password2)){	
?>
			<script>alert("Enter all the fields.");</script>
			<?php
		}

        //If the re-entered password doesn't match the password entered earlier, display appropriate message to the user.
		else if($password!=$password2){		
			?>
			<script>alert("Passwords do not match.");</script>
			<?php
		}
	
		else{				
		//Check whether any other user with same username already exists in the database. If yes, then tell user to enter some other username
			$exist=mysqli_query($con,"SELECT username FROM login_details WHERE username='$username'");
			if(mysqli_num_rows($exist)!=0){
			?>	
	      		<script>alert("Username already exists!!! Please enter another username.");</script>		
				<?php
			}
			else{			
			//Enter the valid user details in the login_details table in the database
        		$count=mysqli_query($con,"INSERT INTO login_details(firstName,lastName,username,password) VALUES('$firstName','$lastName','$username','$password')");
        		
        		//If the user registration is successful, display a link to login 
        		if($count!=0){
        		?>
        			<p align="center">You have sucessfully created an Account !!!<p>
                    <p align="center">Click <a href="login.php">here</a> to login.</p>		
                	<?php
        		}
        		if (false===$count){
        			printf("error: %s\n", mysqli_error($con));
        		}
        	}
		}
    	mysqli_close($con);		
	}
					?>