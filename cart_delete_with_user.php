<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$user_id = $_POST['user_id'];

mysqli_query($con, "delete from cart_list where user_id = '$user_id'");

mysqli_close($con);

?>