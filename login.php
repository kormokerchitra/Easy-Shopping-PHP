<?php 

$con=mysqli_connect('localhost','root','','easy_shopping');

 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values 
 $email = $_POST['email'];
 $password = $_POST['password'];
 $encPassword = md5($password);
 
 //Creating sql query
 $sql = "SELECT * FROM user_list WHERE email='$email' AND password='$encPassword'";
 
 //executing query
 $result = mysqli_query($con,$sql);
 
 //fetching result
 $check = mysqli_fetch_array($result);
 
 //if we got some result 
 if(isset($check)){
 //displaying success 
 echo json_encode(array('user_info'=>$check));
 }else{
 //displaying failure
 echo "failure";
 }
 mysqli_close($con);
 }
?>