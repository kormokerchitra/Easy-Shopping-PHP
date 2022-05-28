<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$product_qnt = $_POST["product_qnt"];
$cart_id = $_POST["cart_id"];

$result = mysqli_query($con, "update cart_list set product_qnt = '$product_qnt' where cart_id = '$cart_id'");

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