<?php
session_start(); 

$user=$_GET['user'];
$group=$_GET['group'];

date_default_timezone_set("Asia/Kolkata");
$time=date("G:i:s");

     $con=mysqli_connect('localhost','root');
     mysqli_select_db($con,'chat');
     $q="UPDATE current SET lastevent='$time' WHERE username='$user' and groupname='$group'";
     $result=mysqli_query($con,$q);
	 
	 $q="SELECT * from current WHERE username='$user' and groupname='$group'";
     $result=mysqli_query($con,$q);
   
     $num=mysqli_num_rows($result);
     mysqli_close($con);
    for($i=1;$i<=$num;$i++)
	{
		$row=mysqli_fetch_array($result); 
            echo $row['lastevent'];
	}
?>