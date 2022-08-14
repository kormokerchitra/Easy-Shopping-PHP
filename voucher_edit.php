<?php
$con=mysqli_connect('localhost','root','','easy_shopping');

$vou_name = $_POST["vou_name"];
$vou_amount = $_POST["vou_amount"];
$vou_exp_date = $_POST["vou_exp_date"];
$vou_exp_amount = $_POST["vou_exp_amount"];
$vou_status = $_POST["vou_status"];
$vou_id = $_POST["vou_id"];


mysqli_query($con, "update voucher_list set voucher_name='$vou_name', voucher_amount='$vou_amount', vou_exp_date='$vou_exp_date', voucher_exp_amount='$vou_exp_amount', voucher_status='$vou_status' where vou_id='$vou_id'");


mysqli_close($con);
 
?>