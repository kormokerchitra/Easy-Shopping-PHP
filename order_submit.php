<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$full_name = $_POST["full_name"];
$total_product = $_POST["total_product"];
$total_price = $_POST["total_price"];
$prod_discount = $_POST["prod_discount"];
$sub_total = $_POST["sub_total"];
$coupon_discount = $_POST["coupon_discount"];
$shipping_cost = $_POST["shipping_cost"];
$total_payable = $_POST["total_payable"];
$payment_method = $_POST["payment_method"];
$address = $_POST["address"];
$phon_number = $_POST["phon_number"];
$delivery_date = $_POST["delivery_date"];

$inv_id = rand(10,1000);

$result = mysqli_query($con,"insert into order_details(order_id, inv_id, full_name, total_product, total_price, prod_discount, sub_total, coupon_discount, shipping_cost, total_payable, payment_method, address, phon_number, delivery_date, status) values(null,'{$inv_id}', '{$full_name}', '{$total_product}', '{$total_price}', '{$prod_discount}', '{$sub_total}', '{$coupon_discount}', '{$shipping_cost}', '{$total_payable}', '{$payment_method}', '{$address}', '{$phon_number}', '{$delivery_date}', 'New')");
 
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