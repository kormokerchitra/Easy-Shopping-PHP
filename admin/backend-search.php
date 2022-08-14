<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect('localhost','root','','easy_shopping');

$base_url="http://localhost/";
$url = $base_url."easy_shopping/product_list.php";
$json = file_get_contents($url);
$json_data = json_decode($json, true);

$product_list = $json_data["product_list"];
$count = count($product_list); 

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
                    echo "<p>" . $row["product_name"] . "</p>";
                    
                    echo "
                    <a href='detail.php?jsonBody='><button class='btn btn-sm btn-primary'><i class='fa fa-info-circle'></i></button></a>
                    ";
                }
            } else{
                echo "<p>No items found</p>";

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