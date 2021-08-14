<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$status = $_POST["status"];
$id = $_POST["id"];


mysqli_query($con, "update order_details set status='$status' where id='$id'");


mysqli_close($con);
 
?>