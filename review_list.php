<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	$user_name=""; $cat_name=""; $product_name=""; $user_id=""; $user_pro_pic="";

	$prod_id = $_POST["prod_id"];
	$cat_id = $_POST["cat_id"];
 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM reviews";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 		if($row["prod_id"] == $prod_id){
 			$cat_id1=$row["cat_id"]; 
 			$user_id1=$row["user_id"]; 
 			$sql2 = "SELECT * FROM product_list WHERE prod_id='$prod_id'";

		 	$product = mysqli_query($con,$sql2);

		 	while($row1 = mysqli_fetch_array($product)){
				$product_name = $row1["product_name"];
		 	}

		 	$sql3 = "SELECT * FROM category_list WHERE cat_id='$cat_id1'";

		 	$category = mysqli_query($con,$sql3);

		 	while($row2 = mysqli_fetch_array($category)){
				$cat_name = $row2["cat_name"];
		 	}

		 	$sql1 = "SELECT * FROM user_list WHERE user_id='$user_id1'";

		 	$user = mysqli_query($con,$sql1);

		 	while($row3 = mysqli_fetch_array($user)){
				$user_name = $row3["full_name"];
				$user_pro_pic = $row3["pro_pic"];
		 	}
		 	//Pushing name and id in the blank array created 
			 array_push($result,array(
			 "rev_id"=>$row['rev_id'],
			 "cat_name"=>$cat_name,
			 "prod_id"=>$prod_id,
			 "product_name"=>$product_name,
			 "full_name"=>$user_name,
			 "pro_pic"=>$user_pro_pic,
			 "rating"=>$row['rating'],
			 "reviews"=>$row['reviews'],
			 "date"=>$row['date'],
			 ));
 		}
 	}

 	echo json_encode(array('list'=>$result));
 
 	mysqli_close($con);

?>