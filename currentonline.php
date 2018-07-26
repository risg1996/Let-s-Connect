<?php
session_start(); 

$user=$_GET['user'];
$group=$_GET['group'];

date_default_timezone_set("Asia/Kolkata");
$time=date("G:i:s",strtotime('-5 seconds'));

$con=mysqli_connect('localhost','root');
 mysqli_select_db($con,'chat');
 
     $r="DELETE from current where lastevent<'$time'";
     $res=mysqli_query($con,$r);
 
     $q="Select * from current where groupname='$group'";
     $result=mysqli_query($con,$q);
     mysqli_close($con);
     $num=mysqli_num_rows($result);
   
    for($i=1;$i<=$num;$i++)
	{
		$row=mysqli_fetch_array($result); 
            if($row['username']==$user)
			    echo "<li> &#x2622; You </li>";
            else
              echo "<li> &#x2622; ".$row['username']."</li>";
	}

?>