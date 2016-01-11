<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Friendz Chat - Home</title>		
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></Script>
		<script src="script.js"></script>
		<script>

		//This function will call history.php which will display the entire chat history
			function getChat(friendUserID){
    			var friendUserNumber=friendUserID;
				var msg=form2.msg.value;

				//Update a web page without reloading the page
	   			//Request data from a server after the page has loaded
   				//Receive data from a server after the page has loaded
				var xmlhttp=new XMLHttpRequest();
		
				//The onreadystatechange event is triggered every time the readyState changes.
    			//The readyState property holds the status of the XMLHttpRequest.
				xmlhttp.onreadystatechange=function(){

					//4: request finished and response is ready
					//200: "OK"
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById('chatlogs').innerHTML=xmlhttp.responseText;
					}
				}	

				//Specifies the type of request, the URL, and if the request should be 
				//handled asynchronously or not.
				xmlhttp.open('GET', 'chat-history.php?friendUserNumber='+friendUserNumber,true);

	    		//Sends the request off to the server.
				xmlhttp.send();	
			}
		</script>

		<script>

		//This function will be called when you press the "Send" button which calls store-chat.php and store the message in the database
			function submitChat(){
	    		var msg=form2.msg.value;
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById('chatlogs').innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open('GET', 'store-chat.php?msg='+msg,true);
				xmlhttp.send();
				form2.msg.value="";

				//This function will call show-chat.php and load the messages in the chat window
				$(document).ready(function(){
        			$.ajaxSetup({cache:true});
        			
	        		//The setInterval() method calls a function 
    	    		//or evaluates an expression at specified intervals (in milliseconds).
					setInterval(function(){$('#chatlogs').load('show-chat.php');}, 1000);		
				});
		
			}
		</script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div class="top_tab">
			<div class="logout">
				<a href="logout.php">Logout</a>
			</div>
			
			<div class="welcome">Welcome to Friendz Chat</div>
		</div>
		
		<form name=form2>
		
		<div class="chat_box">
			<div class="chat_head">Online Friends </div>
		
		<div class="chat_body">
			<div class="user">
<?php 
			   	session_start();
   				error_reporting(0);
   				$userFirstName=$_SESSION['userFirstName'];
   				$userLastName=$_SESSION['userLastName'];
   				$nameOfUser=$_SESSION['username'];
   				$online="online";
   
   				$con=mysqli_connect("localhost","root","root","chat");		
   				if(!$con){
				   	die("Connection Failed!!!".mysqli_connect_error());		
				}

   				$result2=mysqli_query($con,"SELECT * FROM login_details WHERE firstName='$userFirstName'");
   				while($row2=mysqli_fetch_array($result2)){
   					$userID=$row2['id'];

   					//Creata a session variable for the user 
    				$_SESSION['myUserID']=$userID; 	
   				}
   				$id=$_SESSION['myUserID'];

   				// Update the login_details table by setting the status of the logged in user as "online"
   				$result3=mysqli_query($con,"UPDATE login_details SET status='$online' WHERE id='$id'");	

   				//List all the friends who are online 	
   				$result=mysqli_query($con,"SELECT * FROM login_details WHERE status='$online' AND id!='$id'");
?>
<?php 
   				while($row=mysqli_fetch_array($result)){
   				   	$firstName=$row['firstName'];
   					$lastName=$row['lastName'];
   					$username=$row['username'];
   					$friendID=$row['id'];
?>  	
					 <table>
				 		<tr>
				 			<td><div id="<?php echo $friendID;?>"><?php echo $username;?></div></td>
				 		</tr>
				 	</table>  
<?php 
				}
?>
				<script>
				$(document).ready(function(){
<?php
					for ($i = 1; $i <= $friendID; $i++){
?>
						$('#<?php echo $i; ?>').click(function(){
		
		                    //click a friend with whom you wish to chat and a new chat box opens
							$('.msg_wrap').show();
							$('.msg_box').show();
        					display(<?php echo $i; ?>);
		
						});
			<?php   }  ?>
				});
				</script>
				
				<script>
					function display(friendUserID){
						getChat(friendUserID);
					}
				</script>
<?php 
				mysqli_close($con);
?>
			</div>
		</div>
	</div>
	
		<div class="msg_box">
			<div id="msg_head">Message Box
				<div class="close">x</div>
			</div>
			
			<div class="msg_wrap">
				<div class="msg_body">
					<div id="chatlogs"></div>
				</div>
				
				<div class="msf_footer">
					<textarea rows ="3" class="input_msg" name="msg"></textarea>
				</div>
	
				<div class="send">
					<button type="button" class="button" onclick="submitChat()">Send</button>
				</div>
			</div>
		</div>

		<div class="bottom_tab"></div>
		</form>
	</body>

	<div class="logged_user">
		<?php echo $nameOfUser."'s Home";
		?>
	</div>
</html>


