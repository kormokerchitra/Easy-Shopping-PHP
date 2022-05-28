<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$prod_id = $_POST["prod_id"];
	$user_id = $_POST["user_id"];
	$order_id = $_POST["order_id"];
	$product_count = $_POST["product_count"];
 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$result = mysqli_query($con,"insert into order_product_list(order_prod_id, prod_id, user_id, order_id, product_count) values(null,'{$prod_id}', '{$user_id}', '{$order_id}', '{$product_count}')");
 
 //if we got some result 
 if(isset($result)){
 //displaying success 
 echo "Success";
 }else{
 //displaying failure
 echo "failure";
 }

mysqli_close($con);

?>