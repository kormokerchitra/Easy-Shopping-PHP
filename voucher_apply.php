<?php 

$con=mysqli_connect('localhost','root','','easy_shopping');

 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values 
 $voucher_name = $_POST['voucher_name'];
 
 //Creating sql query
 $sql = "SELECT * FROM voucher_list WHERE voucher_name LIKE '%$voucher_name%'";
 
 //executing query
 $check = mysqli_query($con,$sql);
 
 //fetching result
 // $check = mysqli_fetch_array($result);
 

 $result = array();

 	while($row = mysqli_fetch_array($check)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
 "vou_id"=>$row['vou_id'],
 "voucher_name"=>$row['voucher_name'],
 "voucher_amount"=>$row['voucher_amount'],
 "vou_exp_date"=>$row['vou_exp_date'],
 "voucher_status"=>$row['voucher_status']
 ));
 }
 echo json_encode(array('voucher_info'=>$result));
 mysqli_close($con);
 }
?>