<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
  $user_name; $sql;

  $receiver = $_POST["receiver"];

  if($receiver == "admin"){
    $sql = "SELECT * FROM notifications";
  }else{
    $sql = "SELECT * FROM notifications WHERE receiver LIKE '$receiver'";
  }

 	$notification = mysqli_query($con,$sql);

 	$result = array();

 	while($row = mysqli_fetch_array($notification)){
      array_push($result,array(
        "notification_id"=>$row['notification_id'],
        "inv_id"=>$row['inv_id'],
        "status"=>$row['status'],
        "sender"=>$row['sender'],
        "receiver"=>$row['receiver'],
        "seen"=>$row['seen'],
        "datetime"=>$row['datetime'],
      ));
 }

 echo json_encode(array('notification_list'=>$result));
 
 mysqli_close($con);

?>