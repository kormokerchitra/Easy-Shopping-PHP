<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$user_id = $_POST["user_id"];
$password = $_POST["password"];


$done = mysqli_query($con, "update user_list set password='$password' where user_id='$user_id'");

if(isset($done)){
	echo "Success";
}else{
	echo "failure";
}

mysqli_close($con);
 
?>