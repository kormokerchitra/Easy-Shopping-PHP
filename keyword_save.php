<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$keyword = $_POST["keyword"];
	$user_id = $_POST["user_id"];
 	
 	$sql = "SELECT * FROM keyword_search WHERE keyword = '$keyword' AND user_id = '$user_id'";

 	$key = mysqli_query($con,$sql);

 	$data = mysqli_fetch_array($key);

 	if(!isset($data)){
 		$result = mysqli_query($con,"insert into keyword_search(key_id, keyword, user_id) values(null,'{$keyword}', '{$user_id}')");
 
		 //if we got some result 
		 if(isset($result)){
			 //displaying success 
			 echo "Success";
		 }else{
			 //displaying failure
			 echo "failure";
		 }
 	}

 
mysqli_close($con);

?>