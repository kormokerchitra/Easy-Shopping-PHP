<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$prod_id = $_POST['prod_id'];
$cat_id = $_POST['cat_id'];

$counter = 0;

$del_ok = mysqli_query($con, "delete from product_list where prod_id = '$prod_id'");

if($del_ok){
	$sql = "SELECT * FROM category_list WHERE cat_id = '$cat_id'";

 	$cat_info = mysqli_query($con,$sql);

 	$row = mysqli_fetch_array($cat_info);

 	$counter = $row["product_count"];
 	$counter--;

 	$done = mysqli_query($con, "update category_list set product_count='$counter' where cat_id='$cat_id'");

 	if($done){
 		echo "Success";
 	}else{
 		echo "failure";
 	}
}

mysqli_close($con);

?>