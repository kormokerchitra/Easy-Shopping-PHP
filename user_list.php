<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM user_list";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "user_id"=>$row['user_id'],
 "pro_pic"=>$row['pro_pic'],
 "full_name"=>$row['full_name'],
 "username"=>$row['username'],
 "address"=>$row['address'],
 "email"=>$row['email'],
 "phone_num"=>$row['phone_num'],
 ));
 }

 echo json_encode(array('user_list'=>$result));
 
 mysqli_close($con);

?>