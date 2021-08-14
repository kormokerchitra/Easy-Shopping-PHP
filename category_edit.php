<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$cat_name = $_POST["cat_name"];
$id = $_POST["id"];

//$name = "sdf";
//$password = "sdf";
//$email = "sdf@r54";
mysqli_query($con, "update category_list set cat_name='$cat_name' where id='$id'");


mysqli_close($con);
 
?>