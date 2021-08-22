<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$prod_id = $_POST['prod_id'];

mysqli_query($con, "delete from product_list where prod_id = '$prod_id'");

mysqli_close($con);

?>