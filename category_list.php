<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM category_list";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "cat_id"=>$row['cat_id'],
 "cat_name"=>$row['cat_name'],
 "product_count"=>$row['product_count'],
 ));
 }

 echo json_encode(array('cat_list'=>$result));
 
 mysqli_close($con);

?>