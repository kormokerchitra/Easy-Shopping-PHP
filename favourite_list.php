<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM favourite_list";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "prod_id"=>$row['prod_id'],
 "product_name"=>$row['product_name'],
 "cat_id"=>$row['cat_id'],
 "cat_name"=>$row['cat_name'],
 "product_img"=>$row['product_img'],
 "product_code"=>$row['product_code'],
 "product_price"=>$row['product_price'],
 "prod_rating"=>$row['prod_rating'],
 "prod_discount"=>$row['prod_discount'],
 "prod_disc_date"=>$row['prod_disc_date'],
 "prod_description"=>$row['prod_description'],
 "prod_dimension"=>$row['prod_dimension'],
 "product_size"=>$row['product_size'],
 "shipping_weight"=>$row['shipping_weight'],
 "manuf_name"=>$row['manuf_name'],
 "prod_serial_num"=>$row['prod_serial_num'],
  "user_id"=>$row['user_id'],
   "full_name"=>$row['full_name'],
 ));
 }

 echo json_encode(array('favourite_list'=>$result));
 
 mysqli_close($con);

?>