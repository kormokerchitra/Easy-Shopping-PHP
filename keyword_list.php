<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$user_id = $_POST["user_id"];

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM keyword_search WHERE user_id = '$user_id'";

 	$keyword = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($keyword)){
 		
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "key_id"=>$row['key_id'],
 "keyword"=>$row['keyword'],
 "user_id"=>$row['user_id'],
 ));
 }

 echo json_encode(array('keyword_list'=>$result));
 
 mysqli_close($con);

?>