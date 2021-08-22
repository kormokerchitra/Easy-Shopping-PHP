<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$prod_discount = $_POST["prod_discount"];
$prod_disc_date = $_POST["prod_disc_date"];
$prod_id = $_POST["prod_id"];

mysqli_query($con,"insert into product_list(prod_id, prod_discount, prod_disc_date) 
	values(null,'{$prod_discount}','{$prod_disc_date}')");

mysqli_close($con);
 
?>