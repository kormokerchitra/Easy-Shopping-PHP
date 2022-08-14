<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$keyword = $_POST["keyword"];
	$user_id = $_POST["user_id"];
 	
 	$sql = "DELETE FROM keyword_search WHERE keyword = '$keyword' AND user_id = '$user_id'";

 	$key = mysqli_query($con,$sql);

 	if(isset($key)){
		 //displaying success 
		 echo "Success";
	 }else{
		 //displaying failure
		 echo "failure";
	 }

 
mysqli_close($con);

?>