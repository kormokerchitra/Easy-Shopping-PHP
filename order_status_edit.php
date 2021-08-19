<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$status = $_POST["status"];
$order_id = $_POST["order_id"];


mysqli_query($con, "update order_details set status='$status' where order_id='$order_id'");


mysqli_close($con);
 
?>