<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$prod_id = $_POST["prod_id"];
$product_qnt = $_POST["product_qnt"];


$sql = "SELECT * FROM product_list WHERE prod_id='$prod_id'";

$stored_res = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($stored_res)){
	$main_stock = $row['stock'];
	$total = $main_stock - $product_qnt;

	mysqli_query($con, "update product_list set stock='$total' where prod_id='$prod_id'");
}


mysqli_close($con);
 
?>