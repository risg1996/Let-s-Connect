<?php
 session_start();
  $user=$_GET['username'];
  $group=$_GET['groupname'];
  $pass=$_GET['password'];
  
  date_default_timezone_set("Asia/Kolkata");
  $time=date("G:i:s");
  
   $con=mysqli_connect('localhost','root');
   mysqli_select_db($con,'chat');
   $q="Select * from users where groupname='$group'";
   $result=mysqli_query($con,$q);
   $row=mysqli_num_rows($result);
   if($row==0)
   {
	   //adding to users
	   $q="INSERT INTO users(username,groupname,password) values ('$user','$group','$pass')";
       $res=mysqli_query($con,$q);
	   $_SESSION['user']=$user;
	   $_SESSION['group']=$group;
	   $_SESSION['password']=$pass;
	   
	   //default message
	   $newmessage="This is the starting of the chat";
	   $q="INSERT INTO messages(username,groupname,message,messagetime) values ('Developer','$group','$newmessage','$time')";
       $result=mysqli_query($con,$q);
	   
	    //adding to group admin
	   $q="INSERT INTO gpadmin(username,groupname) values ('$user','$group')";
       $res=mysqli_query($con,$q);
	   
	   //adding to current online
	   $q="INSERT INTO current(username,groupname,lastevent) values ('$user','$group','$time')";
       $res=mysqli_query($con,$q);
	   
	   mysqli_close($con);
	   header('location:http://localhost/chatsystem/chatter.php');
   }
   else
   {
	    header('location:http://localhost/chatsystem/newgroup.php?check=1');
   }
?>