<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$notification_id = $_POST["notification_id"];
$receiver = $_POST["receiver"];

$result = mysqli_query($con,"update notifications set seen='1' where notification_id='$notification_id' and receiver='$receiver'");
 
 //if we got some result 
 if(isset($result)){
 	echo "Success";
 }else{
	//displaying failure
	echo "failure";
 }

mysqli_close($con);
 
?>