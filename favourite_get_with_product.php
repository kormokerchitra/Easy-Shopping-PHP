<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$user_id = $_POST["user_id"];
	$prod_id = $_POST["prod_id"];


 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "SELECT * FROM favourite_list WHERE prod_id = '$prod_id' AND user_id = '$user_id'";

 	$fav = mysqli_query($con,$sql);

 	$row = mysqli_fetch_array($fav);

	//if we got some result 
	 if($prod_id == $row["prod_id"]){
		 //displaying success 
		 echo "Success";
	 }else{
		 //displaying failure
		 echo "failure";
	 }
 
 	mysqli_close($con);

?>