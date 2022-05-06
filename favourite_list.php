<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$user_id = $_POST["user_id"];

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM favourite_list";

 	$fav = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($fav)){
 		$prod_id=$row["prod_id"]; 
		$sql2 = "SELECT * FROM product_list WHERE prod_id='$prod_id'";

	 	$product = mysqli_query($con,$sql2);

	 	$row1 = mysqli_fetch_array($product);
	 	$product_name = $row1["product_name"];
	 	$product_price = $row1["product_price"];
	 	$prod_rating = $row1["prod_rating"];
	 	$prod_discount = $row1["prod_discount"];
	 	$product_img = $row1["product_img"];
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "fav_id"=>$row['fav_id'],
 "user_id"=>$row['user_id'],
 "prod_id"=>$row['prod_id'],
 "product_name"=>$product_name,
 "product_price"=>$product_price,
 "prod_rating"=>$prod_rating,
 "prod_discount"=>$prod_discount,
 "product_img"=>$product_img
 ));
 }

 echo json_encode(array('favourite_list'=>$result));
 
 mysqli_close($con);

?>