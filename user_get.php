<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	$user_id = $_POST['user_id'];

 	$sql = "SELECT * FROM user_list WHERE user_id='$user_id'";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "user_id"=>$row['user_id'],
 "full_name"=>$row['full_name'],
 "username"=>$row['username'],
 "address"=>$row['address'],
 "email"=>$row['email'],
 "phone_num"=>$row['phone_num'],
 ));
 }

 echo json_encode(array('user_info'=>$result));
 
 mysqli_close($con);

?>