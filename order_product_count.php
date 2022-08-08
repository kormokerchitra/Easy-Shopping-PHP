<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

	$prod_id = $_POST["prod_id"];

 	$sql = "SELECT * FROM order_product_list WHERE prod_id = '$prod_id'";

 	$prod_list = mysqli_query($con,$sql);
 	
 	$result = array();
 	$order_count=0;

 	while($row = mysqli_fetch_array($prod_list)){
 		
 		$product_count = $row["product_count"];

 		$order_count+=$product_count;
 	}
	
	echo $order_count;

    mysqli_close($con);
?>