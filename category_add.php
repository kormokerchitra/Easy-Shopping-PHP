<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$cat_name = $_POST["cat_name"];

mysqli_query($con,"insert into category_list(id, cat_name, product_count) values(null,'{$cat_name}', '0')");

mysqli_close($con);
 
?>