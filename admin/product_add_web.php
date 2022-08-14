<?php

$file_url = ""; $status = ""; $productImage="";
    $upload_path = 'img/';
 
    // //creating the upload url
    $upload_url = 'easy_shopping/admin/'.$upload_path;

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");

$product_name = $_POST["product_name"];
$cat_id = $_POST["cat_id"];
$product_img = $_POST["product_img"];
$product_code = $_POST["product_code"];
$product_price = $_POST["product_price"];
$prod_discount = $_POST["prod_discount"];
$prod_disc_date = $_POST["prod_disc_date"];
$prod_color = $_POST["prod_color"];
$prod_description = $_POST["prod_description"];
$prod_dimension = $_POST["prod_dimension"];
$product_size = $_POST["product_size"];
$shipping_weight = $_POST["shipping_weight"];
$manuf_name = $_POST["manuf_name"];
$prod_serial_num = $_POST["prod_serial_num"];
$stock = $_POST["stock"];

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

$result = mysqli_query($con,"insert into product_list(prod_id, product_name, cat_id, product_img, product_code, product_price, prod_rating, prod_discount, prod_disc_date, prod_color, prod_description, prod_dimension, product_size, shipping_weight, manuf_name, prod_serial_num, stock) values(null,'{$product_name}', '{$cat_id}', '{$file_url}', '{$product_code}', '{$product_price}', '0', '{$prod_discount}', '{$prod_disc_date}', '{$prod_color}', '{$prod_description}', '{$prod_dimension}', '{$product_size}', '{$shipping_weight}', '{$manuf_name}', '{$prod_serial_num}', '{$stock}')");
 
 //if we got some result 
if(isset($result)){
 //displaying success 
    echo "Success";
}else{
 //displaying failure
    echo "failure";
}

mysqli_close($con);
 
?>