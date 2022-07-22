<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$inv_id = $_POST["inv_id"];
$status = $_POST["status"];
$sender = $_POST["sender"];
$receiver = $_POST["receiver"];

$result = mysqli_query($con,"update notifications set seen='0', status='$status', sender='$sender', receiver='$receiver' where inv_id='$inv_id'");
 
 //if we got some result 
 if(isset($result)){
 	echo "Success";
 }else{
	//displaying failure
	echo "failure";
 }

mysqli_close($con);
 
?>