<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
   $user_name;

 	$sql = "SELECT * FROM order_details ORDER BY order_id DESC";

 	$stored_res = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($stored_res)){
      $user_id = $row["user_id"];
      $sql1 = "SELECT * FROM user_list WHERE user_id = '$user_id'";

      $user = mysqli_query($con,$sql1);
      $row1 = mysqli_fetch_array($user);
      $user_name = $row1["full_name"];

 
       //Pushing name and id in the blank array created 
       array_push($result,array(
       "order_id"=>$row['order_id'],
       "inv_id"=>$row['inv_id'],
       "user_id"=>$row['user_id'],
       "full_name"=>$user_name,
        "total_product"=>$row['total_product'],
         "total_price"=>$row['total_price'],
         "prod_discount"=>$row['prod_discount'],
         "sub_total"=>$row['sub_total'],
         "coupon_discount"=>$row['coupon_discount'],
         "shipping_cost"=>$row['shipping_cost'],
         "total_payable"=>$row['total_payable'],
         "payment_method"=>$row['payment_method'],
         "address"=>$row['address'],
         "phon_number"=>$row['phon_number'],
         "delivery_date"=>$row['delivery_date'],
         "status"=>$row['status'],
       ));
 }

 echo json_encode(array('order_list'=>$result));
 
 mysqli_close($con);

?>