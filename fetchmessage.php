<?php
session_start(); 

$user=$_GET['user'];
$group=$_GET['group'];

$con=mysqli_connect('localhost','root');
 mysqli_select_db($con,'chat');
     $q="Select * from messages where groupname='$group'";
     $result=mysqli_query($con,$q);
     mysqli_close($con);
     $num=mysqli_num_rows($result);
   
    for($i=1;$i<=$num;$i++)
	{
		    $row=mysqli_fetch_array($result); 
		  if($row['username']!='Developer'&&$row['username']!=$user)
		  {
			  echo '<p style="margin:10px 10px;
		             clear:both;
                     float:left;
					 border-radius: 4px;
					 padding:10px;
					 font-weight:100;
					 background-color:#F8F9F9;" ><small><i>'.$row['username'].'</i></small>  : <large><span style="color:#17202A;font-weight:500;font-family:cursive;">'.$row['message'].'</span></large> <i><small> at '.$row['messagetime'].'</i></small></p>';
		  }
		 else if($row['username']==$user)
		      {
			    echo '<p style="margin:10px 10px;
		             clear:both;
					 border-radius: 4px;
					 float:right;
					 word-spacing:2px;
					 padding:10px;
					 font-weight:100;
					 background-color:#F8F9F9;" ><small><i>'.$row['username'].'</i></small>  : <large><span style="color:#17202A;font-weight:500;font-family:cursive;">'.$row['message'].'</span></large> <i><small> at '.$row['messagetime'].'</i></small></p>';
				
		      }
		 else 
			echo '<p style="text-align:center;
		                margin:20px;
						margin-bottom:0px;
						color:#4A235A;
						font-family:sans-serif;
						text-transform:uppercase;
						float:center;" ><b>'.$row['message'].'</b></p><br/>'; 
	}

?>