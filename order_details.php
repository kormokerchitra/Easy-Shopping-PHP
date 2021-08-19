<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM order_details";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "order_id"=>$row['order_id'],
 "inv_id"=>$row['inv_id'],
 "full_name"=>$row['full_name'],
  "total_product"=>$row['total_product'],
   "total_price"=>$row['total_price'],
   "discount"=>$row['discount'],
   "sub_total"=>$row['sub_total'],
   "coupon_discount"=>$row['coupon_discount'],
   "shipping_cost"=>$row['shipping_cost'],
   "total_payable"=>$row['total_payable'],
   "payment_method"=>$row['payment_method'],
   "address"=>$row['address'],
   "phon_number"=>$row['phon_number'],
   "delivery_date"=>$row['delivery_date'],
   "status"=>$row['status'],
 ));
 }

 echo json_encode(array('order_list'=>$result));
 
 mysqli_close($con);

?>