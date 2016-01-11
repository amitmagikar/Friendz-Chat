<?php
session_start();

$friendUserID=$_SESSION['friendUserID'];
$msg=$_REQUEST['msg'];
$myUserID=$_SESSION['myUserID'];


$con=mysqli_connect("localhost","root","root","chat");
if(!$con){

	die("Connection Failed!!!".mysqli_connect_error());
}

//This query stores the details about the sender and receiver of the message in the table logs 
mysqli_query($con, "INSERT INTO logs(user1_id,user2_id,message) VALUES('$myUserID','$friendUserID','$msg') ");

mysqli_close($con);

?>