<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$user_id = $_POST["user_id"];

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM keyword_search WHERE user_id = '$user_id'";

 	$keyword = mysqli_query($con,$sql);

 	$result = array();
 	$result1 = array();

 	while($row = mysqli_fetch_array($keyword)){
 		$keyword_name = $row['keyword'];
 		$sql1 = "SELECT * FROM product_list WHERE product_name LIKE '%$keyword_name%'";

	 	$stored_res = mysqli_query($con,$sql1);

	 	while($row1 = mysqli_fetch_array($stored_res)){

	 		$rev_count=0;
	 		$cat_id = $row1["cat_id"];

	 		$sql2 = "SELECT * FROM category_list WHERE cat_id = '$cat_id'";

		 	$category = mysqli_query($con,$sql2);

		 	$row3 = mysqli_fetch_array($category);
		 	$cat_name = $row3["cat_name"];
		 	$prouct_id = $row1['prod_id'];
		 	$rev_list = "SELECT * FROM reviews WHERE prod_id = '$prouct_id'";
		 	$rev = mysqli_query($con,$rev_list);
		 	while($rev_data = mysqli_fetch_array($rev)){
				$rev_count++;
		 	}
		 	//Pushing name and id in the blank array created 
			 array_push($result1,array(
			 	"prod_id"=>$row1['prod_id'],
			 	"product_name"=>$row1['product_name'],
				 "cat_id"=>$row1['cat_id'],
				 "cat_name"=>$cat_name,
				 "product_img"=>$row1['product_img'],
				 "product_code"=>$row1['product_code'],
				 "product_price"=>$row1['product_price'],
				 "prod_rating"=>$row1['prod_rating'],
				 "prod_discount"=>$row1['prod_discount'],
				 "prod_disc_date"=>$row1['prod_disc_date'],
				 "prod_color"=>$row1['prod_color'],
				 "prod_description"=>$row1['prod_description'],
				 "prod_dimension"=>$row1['prod_dimension'],
				 "product_size"=>$row1['product_size'],
				 "shipping_weight"=>$row1['shipping_weight'],
				 "manuf_name"=>$row1['manuf_name'],
				 "prod_serial_num"=>$row1['prod_serial_num'],
				 "prod_quantity"=>$row1['stock'],
				 "rev_count"=>$rev_count,
			 ));
		}
	}

	echo json_encode(array('product_key_list'=>$result1));
	 
	mysqli_close($con);

?>