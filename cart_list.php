<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	$user_id = $_POST["user_id"];

 	$sql = "SELECT * FROM cart_list WHERE user_id='$user_id'";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 		$prod_id = $row["prod_id"];
 		$sql1	 = "SELECT * FROM product_list WHERE prod_id='$prod_id'";

 		$product = mysqli_query($con,$sql1);
 		$row1 = mysqli_fetch_array($product);
 		$product_name = $row1["product_name"];
 		$product_price = $row1["product_price"];
 		$prod_discount = $row1["prod_discount"];
 		$prod_quantity = $row1["stock"];
 
		 //Pushing name and id in the blank array created 
		 array_push($result,array(
		 "cart_id"=>$row['cart_id'],
		 "cat_id"=>$row['cat_id'],
		 "prod_id"=>$row['prod_id'],
		 "product_name"=>$product_name,
		 "product_price"=>$product_price,
		 "product_qnt"=>$row['product_qnt'],
		 "main_product_qnt"=>$prod_quantity,
		 "prod_discount"=>$prod_discount,
		 "user_id"=>$row['user_id'],
		 ));
 }

 echo json_encode(array('cart_list'=>$result));
 
 mysqli_close($con);

?>