<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	$sql="";
 	$order_id = $_POST["order_id"];
 	$user_id = $_POST["user_id"];

 	if($user_id == ""){
		$sql = "SELECT * FROM order_product_list WHERE order_id = '$order_id'";
 	}else{
 		$sql = "SELECT * FROM order_product_list WHERE order_id = '$order_id' AND user_id = '$user_id'";
 	}

 	$result = array();

 	$prod_list = mysqli_query($con,$sql);
 	while($row = mysqli_fetch_array($prod_list)){
		$prod_id = $row["prod_id"];
 		$sql1	 = "SELECT * FROM product_list WHERE prod_id='$prod_id'";

 		$product = mysqli_query($con,$sql1);
 		$row1 = mysqli_fetch_array($product);
 		$product_name = $row1["product_name"];
 		$product_price = $row1["product_price"];
 		$prod_discount = $row1["prod_discount"];

 		//Pushing name and id in the blank array created 
		 array_push($result,array(
		 "order_prod_id"=>$row['order_prod_id'],
		 "product_name"=>$product_name,
		 "product_price"=>$product_price,
		 "product_count"=>$row['product_count'],
		 "prod_discount"=>$prod_discount,
		 "user_id"=>$row['user_id'],
		 ));
 	}

	echo json_encode(array('list'=>$result));
    mysqli_close($con);
?>