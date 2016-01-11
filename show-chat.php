<?php 

session_start();

$friendUserID=$_SESSION['friendUserID'];
$myUserID=$_SESSION['myUserID'];


$con=mysqli_connect("localhost","root","root","chat");
if(!$con){

	die("Connection Failed!!!".mysqli_connect_error());
}

$result3=mysqli_query($con, "SELECT * FROM logs WHERE user1_id='$myUserID' AND user2_id='$friendUserID' OR user1_id='$friendUserID' AND user2_id='$myUserID'");


$result4=mysqli_query($con, "SELECT * FROM login_details WHERE id='$myUserID'");
$result9=mysqli_query($con, "SELECT * FROM login_details WHERE id='$friendUserID'");
$row7=mysqli_fetch_array($result4);
$row8=mysqli_fetch_array($result9);

//This displays the chat messages sent by the user and his friend to each other in the chat window 
while($row3=mysqli_fetch_array($result3)){

    if($row3['user1_id']==$myUserID){
	
    	echo "<b>".$row7['username']."</b>".":".$row3['message']. "<br>";
    }
    else if($row3['user1_id']==$friendUserID){
    	echo "<b>".$row8['username']."</b>".":".$row3['message']. "<br>";
    }
}

mysqli_close($con);
?>