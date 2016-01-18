Friendz-Chat


A web based Chat application built using HTML5, CSS3, Javascript and PHP. MAMP local server used. 

For running the application on a MAC you will need to install MAMP server and for running on Windows you will need a WAMP server. Create a directory called Chat in www directory. Put all the above files in the Chat directory. 


Then you will need to create a MySQL database called ÒchatÓ. Create two tables in the chat database.
Table 1 - login_details for storing login information about the users
Table 2 - logs for storing chat messages of the users

login_details table should have the following columns -
id int
firstName varchar
lastName varchar
username varchar
password varchar
status varchar null

logs table should have the following columns - 
message_id int
user1_id int
user2_id int
message varchar


After creating the database directly go the following URL to login -
http://localhost:8888/www/Chat/login.php 

If you do not have a username and password the login page will take you the sign up URL  -
http://localhost:8888/www/Chat/register.php


Open two different browsers or if you are using Google chrome open the second browser in Incognito mode. Login using the credentials of one user from the first browser and login using the credentials of some other registered user from the second browser. Now both the users can send and receive messages from one another.


