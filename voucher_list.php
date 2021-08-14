<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');

 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM voucher_list";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "id"=>$row['id'],
 "voucher_name"=>$row['voucher_name'],
 "voucher_amount"=>$row['voucher_amount'],
  "vou_exp_date"=>$row['vou_exp_date'],
   "voucher_status"=>$row['voucher_status'],
 ));
 }

 echo json_encode(array('voucher_list'=>$result));
 
 mysqli_close($con);

?>