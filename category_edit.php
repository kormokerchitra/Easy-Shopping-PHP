<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$cat_name = $_POST["cat_name"];
$cat_id = $_POST["cat_id"];

//$name = "sdf";
//$password = "sdf";
//$email = "sdf@r54";
mysqli_query($con, "update category_list set cat_name='$cat_name' where cat_id='$cat_id'");


mysqli_close($con);
 
?>