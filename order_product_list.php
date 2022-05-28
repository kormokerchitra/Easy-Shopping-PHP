<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	$prod_id = $_POST["prod_id"];
 	$user_id = $_POST["user_id"];

 	$sql = "SELECT * FROM order_product_list WHERE user_id = '$user_id' AND prod_id = '$prod_id'";

 	$prod_list = mysqli_query($con,$sql);
 	$data = mysqli_fetch_array($prod_list);

 	if (isset($data)) {
 		echo "Yes";
 	}else{
 		echo "No";
 	}

    mysqli_close($con);
?>