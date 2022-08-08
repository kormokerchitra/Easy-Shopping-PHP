<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	$sql = "SELECT * FROM order_product_list";

 	$prod_list = mysqli_query($con,$sql);
 	
 	$result = array();
 	$order_count=0;

 	while($row = mysqli_fetch_array($prod_list)){
 		
 		
 		$prod_id = $row["prod_id"];
 		$product_count = $row["product_count"];

 		$sql1 = "SELECT * FROM product_list WHERE prod_id='$prod_id'";

	 		$product = mysqli_query($con,$sql1);
	 		$row1 = mysqli_fetch_array($product);
	 		$product_name = $row1["product_name"];
	 		$product_price = $row1["product_price"];
	 		$prod_discount = $row1["prod_discount"];

	 		$rev_count=0;
	 		$cat_id = $row1["cat_id"];

	 		$sql2 = "SELECT * FROM category_list WHERE cat_id = '$cat_id'";

		 	$category = mysqli_query($con,$sql2);

		 	$row2 = mysqli_fetch_array($category);
		 	$cat_name = $row2["cat_name"];
		 	$rev_list = "SELECT * FROM reviews WHERE prod_id = '$prod_id'";
		 	$rev = mysqli_query($con,$rev_list);
		 	while($rev_data = mysqli_fetch_array($rev)){
				$rev_count++;
		 	}

		 	array_push($result,array(
			 "prod_id"=>$prod_id,
			 "product_name"=>$row1['product_name'],
			 "cat_id"=>$cat_id,
			 "cat_name"=>$cat_name,
			 "product_img"=>$row1['product_img'],
			 "product_code"=>$row1['product_code'],
			 "product_price"=>$row1['product_price'],
			 "prod_rating"=>$row1['prod_rating'],
			 "prod_discount"=>$row1['prod_discount'],
			 "prod_disc_date"=>$row1['prod_disc_date'],
			 "prod_description"=>$row1['prod_description'],
			 "prod_dimension"=>$row1['prod_dimension'],
			 "product_size"=>$row1['product_size'],
			 "shipping_weight"=>$row1['shipping_weight'],
			 "manuf_name"=>$row1['manuf_name'],
			 "prod_serial_num"=>$row1['prod_serial_num'],
			 "prod_quantity"=>$row1['stock'],
			 "rev_count"=>$rev_count,
			 "order_count"=>$product_count,
			 ));
 	}
	
	echo json_encode(array('list'=>$result));

    mysqli_close($con);
?>