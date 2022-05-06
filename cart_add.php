<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$cat_id = $_POST["cat_id"];
$prod_id = $_POST["prod_id"];
$product_qnt = $_POST["product_qnt"];
$user_id = $_POST["user_id"];

$result = mysqli_query($con,"insert into cart_list(cart_id, cat_id, prod_id, product_qnt, user_id) values(null,'{$cat_id}', '{$prod_id}', '{$product_qnt}', '{$user_id}')");
 
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