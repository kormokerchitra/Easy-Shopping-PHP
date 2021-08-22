<?php 

$con=mysqli_connect('localhost','root','','easy_shopping');

 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values 
 $voucher_name = $_POST['voucher_name'];
 
 //Creating sql query
 $sql = "SELECT * FROM voucher_list WHERE voucher_name LIKE '%$voucher_name%'";
 
 //executing query
 $result = mysqli_query($con,$sql);
 
 //fetching result
 $check = mysqli_fetch_array($result);
 
 //if we got some result 
 if(isset($check)){
 //displaying success 
 echo $check["voucher_amount"];
 }else{
 //displaying failure
 echo "failure";
 }
 mysqli_close($con);
 }
?>