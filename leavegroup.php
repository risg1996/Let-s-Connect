<?php
session_start(); 
$user=$_SESSION['user'];
$group=$_SESSION['group'];



     $con=mysqli_connect('localhost','root');
     mysqli_select_db($con,'chat');
     $q="Select * from users where groupname='$group'";
     $result=mysqli_query($con,$q);
	 $num=mysqli_num_rows($result);
	 
     if($num==1)
	 {
		  $q="Delete from users where groupname='$group'";
           mysqli_query($con,$q);
		  $q="Delete from messages where groupname='$group'";
           mysqli_query($con,$q);
		  $q="Delete from current where groupname='$group' and username='$user'";
           mysqli_query($con,$q);  
		   $q="Delete from gpadmin where groupname='$group'";
           mysqli_query($con,$q);
		   mysqli_close($con);
		    
	 }
	 else
	 {
		  $q="Delete from users where groupname='$group' and username='$user'";
           mysqli_query($con,$q);
		  $q="Delete from current where groupname='$group' and username='$user'";
           mysqli_query($con,$q); 
		   mysqli_close($con);
	 }
   session_destroy();
   unset($_SESSION['user']);
   unset($_SESSION['group']);
      header('location:http://localhost/chatsystem/index.php');
  ?>