<?php
session_start(); 

date_default_timezone_set("Asia/Kolkata");
  $time=date("G:i:s");

if(!isset($_SESSION['user'])||!isset($_SESSION['group']))  //check is session varibales have value or not
	header('location:http://localhost/chatsystem/index.php');
if(isset($_GET['groupname']))
{
	$group=$_GET['groupname'];
	$_SESSION['group']=$group;
}
else
  $group=$_SESSION['group'];	
$user=$_SESSION['user'];
$pass=$_SESSION['password'];

$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'chat');
$q="Select * from gpadmin where groupname='$group'";
$result=mysqli_query($con,$q);
$num=mysqli_num_rows($result);
if($num==0)   //delete details if group is already deleted by the admin 
{
  header('location:http://localhost/chatsystem/leavegroup.php');	
}
else
{
   $row=mysqli_fetch_array($result);
   $admin=$row['username'];
}

$q="INSERT INTO current(username,groupname,lastevent) values ('$user','$group','$time')";
$result=mysqli_query($con,$q);
mysqli_close($con);
?>


<!DOCTYPE html>
<html>
<head>
<title> chatter </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/chatter.css" >
<script>
   var user='<?php echo $user;?>';
   var group='<?php echo $group;?>';
   var pass='<?php echo $pass;?>';
   var admin='<?php echo $admin;?>';

   //alert(user+group);
   
   var x=setInterval(fetchmembers,1900);  //current group members
   function fetchmembers()
   {
	   var req=new XMLHttpRequest();
	   req.open("get","http://localhost/chatsystem/fetchmembers.php?user="+user+"&group="+group,true);
	   req.send();
	   req.onreadystatechange=function(){
		   if(req.readyState==4&&req.status==200)
		   {
			 document.getElementById("members").innerHTML=req.responseText;
       		}
	   };
   }
   
   
   var x=setInterval(currentonline,310);     //current online members of the group
   function currentonline()
   {
	   var req=new XMLHttpRequest();
	   req.open("get","http://localhost/chatsystem/currentonline.php?user="+user+"&group="+group,true);
	   req.send();
	   req.onreadystatechange=function(){
		   if(req.readyState==4&&req.status==200)
		   {
			 document.getElementById("online").innerHTML=req.responseText;
       		}
	   };
   }
   
   var x=setInterval(updateevent,999);     //updating lastevent table
   function updateevent()
   {
	   var req=new XMLHttpRequest();
	   req.open("get","http://localhost/chatsystem/updateevent.php?user="+user+"&group="+group,true);
	   req.send();
	   req.onreadystatechange=function(){
		   if(req.readyState==4&&req.status==200)
		   {
			 document.getElementById("tm").innerHTML=req.responseText;
       		}
	   };
   }
   
   
 var firsttime=true; 
 var x=0; 
 var flag=false;
   var x=setInterval(fetchmessage,230);
   
   function fetchmessage()                   //fetching messages from database
   {
	   var req=new XMLHttpRequest();
	   req.open("get","http://localhost/chatsystem/fetchmessage.php?user="+user+"&group="+group,true);
	   req.send();
	   req.onreadystatechange=function(){
		   if(req.readyState==4&&req.status==200)
		   {
			 document.getElementById("content").innerHTML=req.responseText;	
			 if(req.responseText==""&&flag==false)
			 {
				 alert(" This group was Deleted by the admin. Please choose different group otherwise you will be redirected to home page ");
				 flag=true;
			 }
			 
             if(firsttime||req.responseText>x)
			 {
				 var elem=document.getElementById("content");
                 elem.scrollTop=elem.scrollHeight; 
				 firsttime=false;
			 }
             x=req.responseText;			 
		   }
	   };
   }
  
function down()
{
	  firsttime=true;
}



</script>

</head>
<body onLoad="fetchmembers(),fetchmessage(),updateevent(),currentonline()" style="background-image:url('images/b.jpg');background-size:cover;" >

<div id="header">

   <p id="welcome"> welcome <?php echo $user ?>, to group '<?php echo $group ?>'(admin &#9758; <?php echo $admin ?>)</p>
   <div id="logoutlinks">
   <a class="link" href="leavegroup.php">Leave_group</a>
   <a class="link" href="deletegroup.php">Delete_group</a>
   <a class="link" href="logout.php">Logout</a>
   </div>
</div>

<div id="main">
 
<div id="activegroups">
      <table id="groups">
	   <tr>
	       <th> &#x2608; Your groups</th> 
       </tr>
      <?php
	             $con=mysqli_connect('localhost','root');
				 mysqli_select_db($con,'chat');
	              $q="Select * from users where username='$user' and password='$pass'";
                  $result=mysqli_query($con,$q);
                  mysqli_close($con);
                  $num=mysqli_num_rows($result);
   
                 for($i=1;$i<=$num;$i++)
	           {
		        $row=mysqli_fetch_array($result); 
        ?>
		   <tr><td><a href="http://localhost/chatsystem/chatter.php?groupname=<?php echo $row['groupname'] ?>" > &#x2623; <?php echo $row['groupname'] ?></td></a></tr>
      <?php        
	           }  
      ?>
	 </table> 
</div> 

<div id="chatbox" style="background-image:url('images/d.jpg');">

     <div id="content" >
	 </div>
    <div id="sender">
    <form action="messageposter.php" method="get" >
	<input type="text" onchange="down()" placeholder="Enter your message here" autofocus="autofocus" name="newmessage" required />
	<input type="submit" value="send"/>
	</form>
    </div>
</div>

<div id="rightbox">
<div id="currentonline">

     <p>online members of this group </p>
       <ul id="online">
       </ul>
  
</div>  
  
<div id="currentmembers">

  <p> group members </p>
    <ul id="members">
     </ul>

</div> 
</div>

</div>
  
<div id="foot">Made with &hearts; By &#9758; <i>Rishav Gautam</i> &#x262F; <span id="tm"></span></div>
  
</body>
</html>
</html>