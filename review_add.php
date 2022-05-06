<?php

$con=mysqli_connect('localhost','root','','easy_shopping');
 //mysqli_set_charset($con, "utf8");
$rating_total=0; $review_count=0; $all_review=0;
$cat_id = $_POST["cat_id"];
$rating = $_POST["rating"];
$reviews = $_POST["reviews"];
$user_id = $_POST["user_id"];
$date = $_POST["date"];
$prod_id = $_POST["prod_id"];
$product_name = $_POST["product_name"];

mysqli_query($con,"insert into reviews(rev_id, cat_id, rating, reviews, user_id, date, prod_id, product_name) values(null,'{$cat_id}','{$rating}', '{$reviews}', '{$user_id}', '{$date}', '{$prod_id}', '{$product_name}')");

$sql = "SELECT * FROM reviews WHERE prod_id='$prod_id'";

 	$reviews = mysqli_query($con,$sql);

 	while($row = mysqli_fetch_array($reviews)){
 		$review_count++;
		$prod_rating = $row["rating"];
		$rating_total = $rating_total + $prod_rating;
 	}

 	$all_review = $rating_total / $review_count;

mysqli_query($con, "update product_list set prod_rating='$all_review' where prod_id='$prod_id'");

mysqli_close($con);
 
?>