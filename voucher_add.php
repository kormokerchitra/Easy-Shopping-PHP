<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$vou_name = $_POST["vou_name"];
$vou_amount = $_POST["vou_amount"];
$vou_exp_date = $_POST["vou_exp_date"];
$vou_exp_amount = $_POST['vou_exp_amount'];

mysqli_query($con,"insert into voucher_list(vou_id, voucher_name, voucher_amount, vou_exp_date, voucher_exp_amount, voucher_status) 
	values(null,'{$vou_name}','{$vou_amount}','{$vou_exp_date}','{$vou_exp_amount}','1')");

mysqli_close($con);
 
?>