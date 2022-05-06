<?php

$file_url = ""; $status = "";
//this is our upload folder
$upload_path = 'uploads/';
 
//creating the upload url
$upload_url = 'easy_shopping/'.$upload_path;

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$img_base64 = $_POST["image"];
$user_id = $_POST["user_id"];
$username = $_POST["username"];
$full_name = $_POST["full_name"];
$address = $_POST["address"];
$email = $_POST["email"];
$phone_num = $_POST["phone_num"];

$date = time();

if($img_base64!=""){
	//file url to store in the database
    $file_url = $upload_url . $username . '_' . $date . '.png';

    //file path to upload in the server
    $file_path = $upload_path . $username . '_' . $date . '.png';

    try{
	//saving the file
	$status = file_put_contents($file_path,base64_decode($img_base64));
    // move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
	}catch(Exception $e){
	    $response['error']=true;
	    $response['message']=$e->getMessage();
	}
}

$done = mysqli_query($con, "update user_list set pro_pic='$file_url', full_name='$full_name', username='$username', email='$email', phone_num='$phone_num', address='$address' where user_id='$user_id'");

if($done){
	$sql = "SELECT * FROM user_list WHERE user_id='$user_id'";
 
 //executing query
 $result = mysqli_query($con,$sql);
 
 //fetching result
 $check = mysqli_fetch_array($result);
 
 //if we got some result 
 if(isset($check)){
 //displaying success 
 echo json_encode(array('user_info'=>$check));
 }
}else{
	echo "failure";
}

mysqli_close($con);
 
?>