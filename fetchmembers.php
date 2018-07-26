<?php
session_start(); 

$user=$_GET['user'];
$group=$_GET['group'];


$con=mysqli_connect('localhost','root');
 mysqli_select_db($con,'chat');
     $q="Select * from users where groupname='$group'";
     $result=mysqli_query($con,$q);
     mysqli_close($con);
     $num=mysqli_num_rows($result);
   
    for($i=1;$i<=$num;$i++)
	{
		$row=mysqli_fetch_array($result); 
            if($row['username']==$user)
			    echo "<li> &#x265F; you</li>";
            else
              echo "<li> &#x265F; ".$row['username']."</li>";
	}

?>