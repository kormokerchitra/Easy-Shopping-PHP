<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	$user_id = $_POST["user_id"];

 	$sql = "SELECT * FROM cart_list WHERE user_id='$user_id'";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "cart_id"=>$row['cart_id'],
 "cat_id"=>$row['cat_id'],
 "prod_id"=>$row['prod_id'],
 "product_name"=>$row['product_name'],
 "product_price"=>$row['product_price'],
 "product_qnt"=>$row['product_qnt'],
 "prod_discount"=>$row['prod_discount'],
 "user_id"=>$row['user_id'],
 ));
 }

 echo json_encode(array('cart_list'=>$result));
 
 mysqli_close($con);

?>