<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$id=$_POST['id'];

mysqli_query($con, "delete from voucher_list where id = '$id'");

mysqli_close($con);

?>