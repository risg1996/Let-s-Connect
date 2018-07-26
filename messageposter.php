<?php
session_start(); 
$user=$_SESSION['user'];
$group=$_SESSION['group'];
$newmessage=$_GET['newmessage'];

date_default_timezone_set("Asia/Kolkata");
$time=date("G:i:s");

$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'chat');

     $q="Select * from users where groupname='$group' and username='$user'";
     $result=mysqli_query($con,$q);
	 $num=mysqli_num_rows($result);
     if($num>0)
     {
     $q="INSERT INTO messages(username,groupname,message,messagetime) values ('$user','$group','$newmessage','$time')";
     $result=mysqli_query($con,$q);
	 mysqli_close();
    header('location:http://localhost/chatsystem/chatter.php');
     }
	 else
	 {
		 header('location:http://localhost/chatsystem/logout.php');
	 }

?>