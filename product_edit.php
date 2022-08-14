<?php

$file_url = ""; $status = "";
//this is our upload folder
$upload_path = 'product_uploads/';
 
//creating the upload url
$upload_url = 'easy_shopping/'.$upload_path;

$con=mysqli_connect('localhost','root','','easy_shopping');

$product_name = $_POST["product_name"];
$cat_id = $_POST["cat_id"];
$product_img = $_POST["product_img"];
$product_code = $_POST["product_code"];
$product_price = $_POST["product_price"];
$prod_color = $_POST["prod_color"];
$prod_description = $_POST["prod_description"];
$prod_dimension = $_POST["prod_dimension"];
$product_size = $_POST["product_size"];
$shipping_weight = $_POST["shipping_weight"];
$manuf_name = $_POST["manuf_name"];
$prod_serial_num = $_POST["prod_serial_num"];
$prod_id = $_POST["prod_id"];
$stock = $_POST["stock"];

//$name = "sdf";
//$password = "sdf";
//$email = "sdf@r54";
$date = time();
if($product_img!=""){
	//file url to store in the database
    $file_url = $upload_url . $date . '.png';

    //file path to upload in the server
    $file_path = $upload_path . $date . '.png';

    try{
	//saving the file
	$status = file_put_contents($file_path,base64_decode($product_img));
    // move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
	}catch(Exception $e){
	    $response['error']=true;
	    $response['message']=$e->getMessage();
	}
}

$done = mysqli_query($con, "update product_list set product_name='$product_name', cat_id='$cat_id', product_img='$file_url', product_code='$product_code', product_price='$product_price', prod_color='$prod_color', prod_description='$prod_description', prod_dimension='$prod_dimension', product_size='$product_size', shipping_weight='$shipping_weight', manuf_name='$manuf_name', prod_serial_num='$prod_serial_num', stock='$stock' where prod_id='$prod_id'");

//if we got some result 
 if(isset($done)){
 //displaying success 
 echo "Success";
 }else{
 //displaying failure
 echo "failure";
 }
 
mysqli_close($con);
 
?>