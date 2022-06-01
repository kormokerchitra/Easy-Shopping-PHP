<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

	$user_count=0; $product_count=0; $order_count=0; $category_count=0; 
	$voucher_count=0; $discount_count=0; $review_count=0;

	// User count
 	$sql_user = "SELECT * FROM user_list";
 	$user = mysqli_query($con,$sql_user);

 	while($row_user = mysqli_fetch_array($user)){
 		if($row_user["user_id"] != "4"){
 			$user_count++;
 		}
 	}

 	// Product/Discount count
	$sql_product = "SELECT * FROM product_list";
 	$product_list = mysqli_query($con,$sql_product);

 	while($row_product = mysqli_fetch_array($product_list)){
 		$product_count++;

 		if($row_product["prod_discount"] != "0"){
 			$discount_count++;
 		}
 	}

 	// Order Count
 	$sql_order_list = "SELECT * FROM order_details";
 	$order_list = mysqli_query($con,$sql_order_list);

 	while($row_order = mysqli_fetch_array($order_list)){
 		$order_count++;
 	}

 	// Category Count
 	$sql_category = "SELECT * FROM category_list";
 	$category_list = mysqli_query($con,$sql_category);

 	while($row_category = mysqli_fetch_array($category_list)){
 		$category_count++;
 	}

 	// Voucher Count
 	$sql_voucher = "SELECT * FROM voucher_list";
 	$voucher_list = mysqli_query($con,$sql_voucher);

 	while($row_voucher = mysqli_fetch_array($voucher_list)){
 		$today = date("d-m-Y");
 		$expire=$row_voucher["vou_exp_date"];
 		$today_time = strtotime($today);
		$expire_time = strtotime($expire);
 		if($row_voucher["voucher_status"] == 1 && $expire_time > $today_time){
 			$voucher_count++;
 		}
 	}

 	// Review Count
 	$sql_review = "SELECT * FROM reviews";
 	$review_list = mysqli_query($con,$sql_review);

 	while($row_review = mysqli_fetch_array($review_list)){
 		$review_count++;
 	}

 	$json = array(
	 "user_count"=>$user_count,
	 "product_count"=>$product_count,
	 "discount_count"=>$discount_count,
	 "order_count"=>$order_count,
	 "category_count"=>$category_count,
	 "voucher_count"=>$voucher_count,
	 "review_count"=>$review_count,
	);

 	echo json_encode($json);
 
 	mysqli_close($con);

?>