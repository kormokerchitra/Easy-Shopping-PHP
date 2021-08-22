<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$product_name = $_POST["product_name"];
$cat_id = $_POST["cat_id"];
$cat_name = $_POST["cat_name"];
$product_img = $_POST["product_img"];
$product_code = $_POST["product_code"];
$product_price = $_POST["product_price"];
$prod_discount = $_POST["prod_discount"];
$prod_disc_date = $_POST["prod_disc_date"];
$prod_description = $_POST["prod_description"];
$prod_dimension = $_POST["prod_dimension"];
$product_size = $_POST["product_size"];
$shipping_weight = $_POST["shipping_weight"];
$manuf_name = $_POST["manuf_name"];
$prod_serial_num = $_POST["prod_serial_num"];

$result = mysqli_query($con,"insert into product_list(prod_id, product_name, cat_id, cat_name, product_img, product_code, product_price, prod_rating, prod_discount, prod_disc_date, prod_description, prod_dimension, product_size, shipping_weight, manuf_name, prod_serial_num) values(null,'{$product_name}', '{$cat_id}', '{$cat_name}', '{$product_img}', '{$product_code}', '{$product_price}', '0', '{$prod_discount}', '{$prod_disc_date}', '{$prod_description}', '{$prod_dimension}', '{$product_size}', '{$shipping_weight}', '{$manuf_name}', '{$prod_serial_num}')");
 
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