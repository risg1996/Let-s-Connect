<?php
   if(isset($_GET['check']))
   {
	  if($_GET['check']==1)
		  $c="Group name does not exist";
	  else
		  $c="Group already have a user of this username";
   }
   else 
		  $c="";
 
?>

<!DOCTYPE html>
<html>
<head>
<title> join group </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/joingroup.css"></link>

<script>

function checker()
{
	var aux= document.getElementsByName("groupname");
	var data=aux[0].value;
	var format = /[!#$%^&*()+\-=\[\]{};':"\\|,.<>\/?]/;

	var aux= document.getElementsByName("username");
	var data2=aux[0].value;
	
	var length1=data.length;
	var length2=data2.length;
	if(format.test(data)||format.test(data2)||length1>19||length2>19)
	 {
		return false;
	 }
	 else
		return true;
}


function groupnamechange()
{
	var aux= document.getElementsByName('groupname');
	var data=aux[0].value;
	var format = /[!#$%^&*()+\-=\[\]{};':"\\|,.<>\/?]/;
	var len=data.length;
	if(format.test(data)==true)
	 {
		document.getElementById('flag1').innerHTML="Do not use special characters";
	 }
	else if(len>19)
		ocument.getElementById('flag1').innerHTML="Length of input should be less than 20 characters";
	else
		document.getElementById('flag1').innerHTML="";
}

function exist()
{
	document.getElementById('flag1').innerHTML="<?php echo $c; ?>";
}

function usernamechange()
{
	var aux= document.getElementsByName('username');
	var data=aux[0].value;
	var format = /[!#$%^&*()+\-=\[\]{};':"\\|,.<>\/?]/;
	var len=data.length;
	if(format.test(data)==true)
	 {
		document.getElementById('flag2').innerHTML="Do not use special characters";
	 }
	 else if(len>19)
		document.getElementById('flag2').innerHTML="Length of input should be less than 20 characters";	
	else
	  document.getElementById('flag2').innerHTML="Please use correct username and password otherwise new will be created(for old users)";
}

</script>

</head>
<body onLoad="exist()" style="background-image:url('images/b.jpg');background-size:cover;">

    <div id="header">
    <p>Join Group</p>
    </div>
    
	
	<div id="main">
    <div id="about">
    <h4>Instructions</h4>
	<p>&#x261B; &nbsp; <i>To join a group you need not have a username and password.</i> </p>
	<p>&#x261B; &nbsp; <i>If you don't have any username than new username will be created which you had typed in the input field.</i></p>
	<p>&#x261B; &nbsp; <i>If you already have a username and password and want this group to be shown in your account than use that username and password
	                      otherwise new username and password will be created for this group.</i></p>
	<p>&#x261B; &nbsp; <i>A group can not have 2 or more users of same username, so if you want to join that group than you have to create a new username.</i></p>
	<p>&#x261B; &nbsp; <i> A group name and username can not have more than 20 and special characters(only alphabets,numbers and underscore are alloowed).</i></p>				
     </div>
    <div id="right">
	
	<form action="validation_jg.php" method="get" onSubmit="return checker()">
    <table id="table">
    <tr>
	   <td><input type="text" placeholder="Group Name" name="groupname" onChange="groupnamechange()" required /></td>
	</tr>
    <tr>
	   <td> <input type="text" placeholder="Username" name="username" onChange="usernamechange()" required /></td>
	</tr>
	<tr>
	   <td><input type="password" placeholder="Password" name="password" required /></td>
	</tr>
	<tr>
	  <td><input type="submit" value="JOIN GROUP" /></td>
	</tr>
    </table>
	    <p id="flag1"></p>
	    <p id="flag2"></p>
	</form>
    </div>
    </div>
	
	<div id="foot">Made with &hearts; By &#9758; <i>Rishav Gautam</i></div>

</body>
</html>