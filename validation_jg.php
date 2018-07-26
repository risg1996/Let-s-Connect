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
   if($row==0)  //group does not exist
   {
	   mysqli_close($con);
	     header('location:http://localhost/chatsystem/joingroup.php?check=1');
   }
   else
   {
	     $q="Select * from users where groupname='$group' and username='$user' and password='$pass'";
		 $result=mysqli_query($con,$q);
		 $row=mysqli_num_rows($result);
	    if($row>=1)            		 //login
         {			
		 $_SESSION['user']=$user;
	     $_SESSION['group']=$group;
	     $_SESSION['password']=$pass;
		 
		 $q="INSERT INTO current(username,groupname,lastevent) values ('$user','$group','$time')";
         $res=mysqli_query($con,$q);
	     mysqli_close($con);
	     header('location:http://localhost/chatsystem/chatter.php');
	    }
	 else                                                //signup
	   {	
		 $q="Select * from users where groupname='$group' and username='$user'";
		 $result=mysqli_query($con,$q);
		 $row=mysqli_num_rows($result);
		 if($row>=1)                                      //group already have a user of same name
		 {
			 mysqli_close($con);
			  header('location:http://localhost/chatsystem/joingroup.php?check=2');
		 }
		 else                                              // new user is added to the group
		 {
			 $q="INSERT INTO users(username,groupname,password) values ('$user','$group','$pass')";
             $res=mysqli_query($con,$q);
			 $_SESSION['user']=$user;
	         $_SESSION['group']=$group;
	         $_SESSION['password']=$pass;
			 
			  $q="INSERT INTO current(username,groupname,lastevent) values ('$user','$group','$time')";
              $res=mysqli_query($con,$q);
			 
	         mysqli_close($con);
	         header('location:http://localhost/chatsystem/chatter.php');
		 }
		 
	   }
	}
?>