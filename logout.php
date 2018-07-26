<?php
session_start();

$user=$_SESSION['user'];
$group=$_SESSION['group'];

$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'chat');
$q="Delete from current where groupname='$group' and username='$user'";
$result=mysqli_query($con,$q);

 unset($_SESSION['user']);
 unset($_SESSION['group']);
 session_destroy();
 header('location:http://localhost/chatsystem/index.php');

?>