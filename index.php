<?php
date_default_timezone_set("Asia/Kolkata");
$time=date("G:i:s");
?>


<!DOCTYPE html>
<html>
<head>
<title>chat system</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/index.css"></link>
</head>
<body style="background-image:url('images/c.jpg');background-size:cover;" >
<div id="header">
   <p>Welcome to Let's Connect</p>
</div>
<div id="main">
<div id="about">
    <h4>About</h4>
	<p>&#x261B; &nbsp; <i><b>Let's Connect</b> is a WEB APP using which you can talk to anyone you want through Internet.</i> </p>
	<p>&#x261B; &nbsp; <i>You can create your own groups here with any name and everyone can join you.</i> </p>
	<p>&#x261B; &nbsp; <i>If you want to be anonymous choose any other username and password and new account
                       will be created for you although you will not be able to see your other groups in that account.</i></p>
	<p>&#x261B; &nbsp; <i>You can create/join any number of groups. </i></p>
	<p>&#x261B; &nbsp; <i>If you leave the group than you will be deleted from the group and if you want you can join that group again through join group tab.</i></p>
	<p>&#x261B; &nbsp; <i>You can see all your groups, members in those groups and currently online members of those groups in your account
	                      and you can select any of your groups to chat.</i></p>
	<p>&#x261B; &nbsp; <i>Only admin can Delete the group and if you are the last person of the group than you can leave the group and 
	                    group will be deleted automatically.</i></p>					
</div>
<div id="right">
<table id="table">
  <tr><th>CREATE/JOIN GROUP</th></tr>
  <tr><td><a href="newgroup.php">Create New Group</td></a></tr>
  <tr><td><a href="joingroup.php">Join An Existing Group</td></a></tr>
</table>
</div>
</div>

<div id="foot">Made with &hearts; By &#9758; <i>Rishav Gautam</i></div>

</body>
</html>