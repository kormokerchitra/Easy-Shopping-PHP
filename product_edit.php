<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$product_name = $_POST["product_name"];
$cat_id = $_POST["cat_id"];
$product_img = $_POST["product_img"];
$product_code = $_POST["product_code"];
$product_price = $_POST["product_price"];
$prod_description = $_POST["prod_description"];
$prod_dimension = $_POST["prod_dimension"];
$product_size = $_POST["product_size"];
$shipping_weight = $_POST["shipping_weight"];
$manuf_name = $_POST["manuf_name"];
$prod_serial_num = $_POST["prod_serial_num"];
$id = $_POST["id"];

//$name = "sdf";
//$password = "sdf";
//$email = "sdf@r54";
mysqli_query($con, "update product_list set product_name='$product_name', cat_id='$cat_id', product_img='$product_img', product_code='$product_code', product_price='$product_price', prod_description='$prod_description', prod_dimension='$prod_dimension', product_size='$product_size', shipping_weight='$shipping_weight', manuf_name='$manuf_name', prod_serial_num='$prod_serial_num' where id='$id'");


mysqli_close($con);
 
?>