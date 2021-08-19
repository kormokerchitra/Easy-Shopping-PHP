<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$vou_id=$_POST['vou_id'];

mysqli_query($con, "delete from voucher_list where vou_id = '$vou_id'");

mysqli_close($con);

?>