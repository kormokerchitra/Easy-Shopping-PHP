<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$cat_id=$_POST['cat_id'];

mysqli_query($con, "delete from category_list where cat_id = '$cat_id'");

mysqli_close($con);

?>