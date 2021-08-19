<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$prod_discount = $_POST["prod_discount"];
$prod_disc_date = $_POST["prod_disc_date"];
$prod_id = $_POST["prod_id"];


mysqli_query($con, "update product_list set prod_discount='$prod_discount', prod_disc_date='$prod_disc_date' where prod_id='$prod_id'");


mysqli_close($con);
 
?>