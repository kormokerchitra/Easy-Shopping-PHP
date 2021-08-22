<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$product_count = $_POST["product_count"];
$cat_id = $_POST["cat_id"];

//$name = "sdf";
//$password = "sdf";
//$email = "sdf@r54";
mysqli_query($con, "update category_list set product_count='$product_count' where cat_id='$cat_id'");


mysqli_close($con);
 
?>