<?php
	session_start();
	$myUserID=$_SESSION['myUserID'];
	$offline="offline";

	$con=mysqli_connect("localhost","root","root","chat");
	if(!$con){	
		die("Connection Failed!!!".mysqli_connect_error());
	}

    //This query sets the status of the logged in user to offline when he clicks on the logout button
	$result4=mysqli_query($con,"UPDATE login_details SET status='$offline' WHERE id='$myUserID'");

	mysqli_close($con);

	echo "You have logged out !!!";

	echo " Click "?><a href="login.php">here</a><?php echo " to Sign In again...";
?>

<html>
	<head>
		<title>Friendz Chat - Logged out</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
</html>