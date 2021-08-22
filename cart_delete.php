<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$cart_id = $_POST['cart_id'];

mysqli_query($con, "delete from cart_list where cart_id = '$cart_id'");

mysqli_close($con);

?>