<?php

	$con = mysqli_connect('localhost','root','','easy_shopping');
	
	$user_id = $_POST["user_id"];
	$prod_id = $_POST["prod_id"];


 	// if($con){
 	// 	echo "ok";
 	// }else{
 	// 	echo "not ok";
 	// }

 	$sql = "DELETE FROM favourite_list WHERE prod_id = '$prod_id' and user_id = '$user_id'";

	$fav_del = mysqli_query($con,$sql);
	//if we got some result 
	 if(isset($fav_del)){
		 //displaying success 
		 echo "Success";
	 }else{
		 //displaying failure
		 echo "failure";
	 }
 
 	mysqli_close($con);

?>