<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM reviews";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "rev_id"=>$row['rev_id'],
 "cat_name"=>$row['cat_name'],
 "prod_id"=>$row['prod_id'],
 "product_name"=>$row['product_name'],
  "full_name"=>$row['full_name'],
 "rating"=>$row['rating'],
 "reviews"=>$row['reviews'],
  "date"=>$row['date'],
 ));
 }

 echo json_encode(array('list'=>$result));
 
 mysqli_close($con);

?>