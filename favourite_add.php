<?php

$con=mysqli_connect('localhost','root','','easy_shopping');

$user_id = $_POST["user_id"];
$prod_id = $_POST["prod_id"];

mysqli_query($con,"insert into favourite_list(fav_id, user_id, prod_id) values(null,'{$user_id}', '{$prod_id}')");

mysqli_close($con);
 
?>