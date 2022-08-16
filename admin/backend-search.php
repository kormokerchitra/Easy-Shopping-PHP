<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect('localhost','root','','easy_shopping');

$base_url="http://localhost/easy_shopping/product_uploads/";
//$url2 = $base_url."easy_shopping/product_uploads/";
// $json = file_get_contents($url);
// $json_data = json_decode($json, true);



// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM product_list WHERE product_name LIKE ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                    $discount_price=0;

                    $prod_id = $row["prod_id"];
                    $cat_id = $row["cat_id"];
                    $cat_name = "test";
                    $img =$row["product_img"];
                    $product_price = $row["product_price"];
                    $product_rating = $row["prod_rating"];
                    $rating_round = round($product_rating, 2);
                    $rating = sprintf('%.2f', $rating_round);



                    $product_name = $row["product_name"];
                    $product_code = $row["product_code"];
                    $stock = $row["stock"];
                    $product_price = $row["product_price"];
                    $prod_discount = $row["prod_discount"];
                    $prod_description =$row["prod_description"];
                    $prod_dimension = $row["prod_dimension"];
                    $prod_size = $row["product_size"];
                    $shipping_weight = $row["shipping_weight"];
                    $manuf_name = $row["manuf_name"];
                    $prod_serial_num = $row["prod_serial_num"];
                    $prod_quantity = $row["stock"];
    				$rev_count = '2';

//    				mysqli_query($link, "SELECT count(*) FROM reviews WHERE prod_id = '$prod_id'");
     //                if($rev_count = mysqli_query($link, "SELECT * FROM reviews WHERE prod_id = '$prod_id'")){

					//     $rowcount=mysqli_num_rows($rev_count);
					    
					// }
     //                $row1 = mysql_fetch_array($rev_count);
					// $total = $row1[0];



                    $prod_color=$row["prod_color"];

                    $data = array(

                            "prod_id" => $prod_id,
                            "product_name"=>$row['product_name'],
                            "cat_id" => $cat_id,
                            "cat_name" => $cat_name,
                            "product_img" => $img,
                            "product_code" => $product_code,
                            "product_price" => $product_price,
                            "prod_rating" => $rating,
                            "prod_discount" => $prod_discount,
                            "prod_disc_date" => "",
                            "prod_color" => $prod_color,
                            "prod_description" => $prod_description,
                            "prod_dimension" => $prod_dimension,
                            "product_size" => $prod_size,
                            "shipping_weight" => $shipping_weight, 
                            "manuf_name" => $manuf_name,
                            "prod_serial_num" => $prod_serial_num,
                            "prod_quantity" => $prod_quantity,
                            
                            "rev_count" =>"",
              

                            

                        );

                    $s = json_encode($data);
                    echo "<p>" . $row["product_name"] . "</p>";
                    
                    echo "
                    <a href='detail.php?jsonBody=$s' class='btn btn-sm btn-primary'>View</a>
                    ";
                }
            } else{
                echo "<p>No matches found</p>";

            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>