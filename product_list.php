<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	$cat_name;
 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM product_list";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 		$rev_count=0;
 		$cat_id = $row["cat_id"];

 		$sql1 = "SELECT * FROM category_list WHERE cat_id = '$cat_id'";

	 	$category = mysqli_query($con,$sql1);

	 	$row1 = mysqli_fetch_array($category);
	 	$cat_name = $row1["cat_name"];
	 	$prouct_id = $row['prod_id'];
	 	$rev_list = "SELECT * FROM reviews WHERE prod_id = '$prouct_id'";
	 	$rev = mysqli_query($con,$rev_list);
	 	while($rev_data = mysqli_fetch_array($rev)){
			$rev_count++;
	 	}
 
		 //Pushing name and id in the blank array created 
		 array_push($result,array(
		 "prod_id"=>$row['prod_id'],
		 "product_name"=>$row['product_name'],
		 "cat_id"=>$row['cat_id'],
		 "cat_name"=>$cat_name,
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
		 "prod_quantity"=>$row['stock'],
		 "rev_count"=>$rev_count,
		 ));
 }

 echo json_encode(array('product_list'=>$result));
 
 mysqli_close($con);

?>