<?php

    $prod_id = "";
    $isSuccess="false";
    $itemCount=0;
    $totalProductInt=0;
    $cat_count=0;  

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/product_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $cat_id = $_GET['cat_id'];
    $cat_name = $_GET['cat_name'];
    $product_list = $json_data["product_list"];
    $count = count($product_list);
    
    $title_name = "";
    if($cat_name == ""){
        $title_name = "Product List";
    }else{
        $title_name = $cat_name;
    }

    if(isset($_POST['yesButton'])) {
        $prodId = $_POST['prodid'];
        $url1 = $base_url."easy_shopping/product_delete.php";
        $postdata = http_build_query(
            array(
                'prod_id' => $prodId,
            )
        );

        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);

        $response = file_get_contents($url1, false, $context);
        $isSuccess = "true";
        // header("Location: products.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $cat_id = $_GET['cat_id'];
        $cat_name = $_GET['cat_name'];
        $product_list = $json_data["product_list"];
        $count = count($product_list);
    }

    if($isSuccess == "true"){
        $url_category = $base_url."easy_shopping/category_list.php";
        $json_category = file_get_contents($url_category);
        $json_data_category = json_decode($json_category, true);

        $prodId = $_POST['prodid'];

        $cat_list = $json_data_category["cat_list"];
        $count = count($cat_list);
        for ($i=0; $i < $count; $i++) { 
            $categoryId = $cat_list[$i]["cat_id"];
            if($categoryId==$cat_id){
                $cat_count = $cat_list[$i]["product_count"];
                $cat_count--;
            }
        }

        $itemCount = $cat_count;
        $totalProductInt -= $itemCount;

        $url3 = $base_url."easy_shopping/category_product_count.php";
        $postdata = http_build_query(
            array(
                'cat_id' => $categoryId,
                'product_count' => $totalProductInt,
            )
        );

        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);

        $response = file_get_contents($url3, false, $context);
    }

    include "header.php";

?>

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">   
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <nav class="position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-grey" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                        <div class="navbar-nav w-100 overflow-hidden" style="height: auto">
                            <!-- <a href="#" class="nav-link">
                                <div class="nav-profile-image">
                                    <img src="img/cat-3.jpg" alt="profile" width="50">
                                </div>
                                <br/> -->
                            <div class="nav-profile-text d-flex flex-column pt-4">
                                <h5 class="font-weight-bold text-center mb-2">Hello Admin</h5>
                                <!-- <h6 class="text-primary">Change Password</h6> -->
                            </div>
                                <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                            </a> -->
                            <a href="dashboard.php" class="nav-item nav-link"><i class="fas fa-folder"></i> Dashboard</a>
                            <a href="userlist.php" class="nav-item nav-link"><i class="fas fa-user-alt"></i> User List</a>
                            <a href="categorylist.php" class="nav-item nav-link"><i class="fas fa-shapes"></i> Category List</a>      
                            <a href="products.php?cat_id=&cat_name=" class="nav-item nav-link active"><i class="fas fa-shopping-bag"></i> Product List</a>
                            <a href="discountlist.php" class="nav-item nav-link"><i class="fa fa-list-alt"></i> Discount List</a>
                            <a href="orderlist.php" class="nav-item nav-link"><i class="fas fa-cart-plus"></i> Order List</a>
                            <a href="couponlist.php" class="nav-item nav-link"><i class="fa fa-gift"></i> Voucher/Coupon List</a>
                            <a href="reviewlist.php" class="nav-item nav-link"><i class="fas fa-star"></i> Review List</a>
                            <a href="profile.php" class="nav-item nav-link"><i class="fas fa-user-circle"></i> Profile</a>
                        </div>
                    </nav>
                </nav>
            </div>
            <div class="col-lg-9">
                <!-- Product List Start -->
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4"><?php echo $title_name; ?></h2>           <div>
                                <a href="addproduct.php"><button class="btn btn-primary py-2 px-4" type="submit" id="prodAdd" style="border-radius: 25px 25px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Product</button></a>
                            </div>
                        </div>

                        <?php
                            if($isSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Product deleted successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }
                        ?>

                    </div>
                    <div class="container-fluid pt-4">
                        <div class="row px-xl-10">
                            <div class="col-lg-12 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-primary text-dark">
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Product Name</th>
                                            <th>Rating</th>
                                            <th>Stock</th>
                                            <th>Product Price (Tk.)</th>
                                            <th>Discount (%)</th>
                                            <th>View Details</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                        <?php
                                            $sum=0; 
                                            for ($i=0; $i < $count; $i++) { 
                                                $discount_price=0;
                                                $catID = $product_list[$i]["cat_id"];
                                                $img =$base_url.$product_list[$i]["product_img"];
                                                //$img =$base_url."easy_shopping/product_uploads/".$product_list[$i]["product_img"];
                                                $prod_id = $product_list[$i]["prod_id"];
                                                $product_name = $product_list[$i]["product_name"];
                                                $stock = $product_list[$i]["prod_quantity"];
                                                $product_price = $product_list[$i]["product_price"];
                                                $prod_discount = $product_list[$i]["prod_discount"];
                                                $product_price = $product_list[$i]["product_price"];
                                                $product_rating = $product_list[$i]["prod_rating"];
                                                $rating_round = round($product_rating, 2);
                                                $rating = sprintf('%.2f', $rating_round);
                                                $rev_count = $product_list[$i]["rev_count"];

                                                if($product_list[$i]["product_img"]==""){
                                                    $img = 'img/product_back.jpg';
                                                }

                                                if($prod_discount!=0){
                                                    $discount_price = $product_price - ($product_price * ($prod_discount / 100));
                                                    $disc_price = sprintf('%.2f', $discount_price);
                                                }

                                                $amountStr = ""; $discountStr = ""; $reviewStr = "";
                                                if($discount_price != 0){
                                                    $amountStr = "<td class='align-middle'><s>$product_price</s><br/>$disc_price</td>";

                                                    $discountStr = "$prod_discount";
                                                }else{
                                                    $amountStr = "<td class='align-middle'<s>$product_price</td>";
                                                    $discountStr = "N/A";
                                                }

                                                if($product_rating!=0){
                                                    $reviewStr ="<td class='align-middle'><i class='fas fa-star text-primary'></i><Br/>$rating ($rev_count)</td>";
                                                }else{
                                                    $reviewStr = "<td class='align-middle'>No rating</td>";
                                                }

                                                $jsonBody = json_encode($product_list[$i]);

                                                //$modal1Id = "myModal1".$prod_id;

                                                if($cat_id != "" && $cat_id == $catID){
                                                    $sum=$sum+1;

                                                    $modal1Id = "myModal1".$prod_id;

                                                    // Product List Show from Specific Category //
                                                    echo "<tr>
                                                        <td class='align-middle'>$sum.</td>
                                                        <td class='align-middle'><img src='$img' alt='' style='width: 50px;'><br/>$product_name</td>"
                                                        ."$reviewStr"
                                                        ."<td class='align-middle'>$stock</td>"
                                                        ."$amountStr"
                                                        ."<td class='align-middle'>$discountStr</td>
                                                        
                                                        <td class='align-middle'>
                                                            <a href='detail.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-info-circle'></i></button></a>
                                                        </td>
                                                        <td class='align-middle'>
                                                            <a href='editproduct.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-edit'></i></button></a>
                                                        </td>
                                                        <td class='align-middle'>
                                                            <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='deleteprod' onclick=document.getElementById('$modal1Id').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-trash'></i></button></a>
                                                        </td>
                                                    </tr>";


                                                    // Product Delete Modal //
                                                    echo "<div id='$modal1Id' class='modal'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <br/>
                                                                <div class='text-center mb-0 pt-4'>
                                                                    <h4 class='section-title px-5'><span class='px-2'>Delete Product</span></h4>
                                                                </div>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                                                    <div class='row justify-content-center px-xl-5'>
                                                                        <div class='col-lg-12 mb-5'>
                                                                            <div class='contact-form'>
                                                                                <div id='success'></div>
                                                                                <form name='sentMessage' id='contactForm' method='POST'>
                                                                                    <div class='control-group'>
                                                                                        <p class='text-center'>Do you want to delete $product_name?</p>
                                                                                        <input type='hidden' class='form-control' placeholder='' name = 'prodid' value='$prod_id' />
                                                                                        <div class='row justify-content-center'>
                                                                                            <button class='btn btn-primary py-2 px-4 bg-red' type='submit' id='noButton' name='noButton' style='border-radius: 25px 25px;'>No</button>&nbsp;&nbsp;&nbsp;
                                                                                            <button class='btn btn-primary py-2 px-4 bg-green' type='submit' id='yesButton' name='yesButton' style='border-radius: 25px 25px;'>Yes</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                        </div>
                                                    </div>";
                                                }

                                                if($cat_id == ""){
                                                    $sum=$sum+1;

                                                    $modal1Id = "myModal1".$prod_id;

                                                    // All Product List Show //
                                                    echo "<tr>
                                                        <td class='align-middle'>$sum.</td>
                                                        <td class='align-middle'><img src='$img' alt='' style='width: 50px;'><br/>$product_name</td>"
                                                        ."$reviewStr"
                                                        ."<td class='align-middle'>$stock</td>"
                                                        ."$amountStr"
                                                        ."<td class='align-middle'>$discountStr</td>
                                                        
                                                        <td class='align-middle'>
                                                            <a href='detail.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-info-circle'></i></button></a>
                                                        </td>
                                                        <td class='align-middle'>
                                                            <a href='editproduct.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-edit'></i></button></a>
                                                        </td>
                                                        <td class='align-middle'>
                                                            <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='deleteprod' onclick=document.getElementById('$modal1Id').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-trash'></i></button></a>
                                                        </td>   
                                                    </tr>";

                                                    // Product Delete Modal //
                                                    echo "<div id='$modal1Id' class='modal'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <br/>
                                                                <div class='text-center mb-0 pt-4'>
                                                                    <h4 class='section-title px-5'><span class='px-2'>Delete Product</span></h4>
                                                                </div>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                                                    <div class='row justify-content-center px-xl-5'>
                                                                        <div class='col-lg-12 mb-5'>
                                                                            <div class='contact-form'>
                                                                                <div id='success'></div>
                                                                                <form name='sentMessage' id='contactForm' method='POST'>
                                                                                    <div class='control-group'>
                                                                                        <p class='text-center'>Do you want to delete $product_name?</p>
                                                                                        <input type='hidden' class='form-control' placeholder='' name = 'prodid' value='$prod_id' />
                                                                                        <div class='row justify-content-center'>
                                                                                            <button class='btn btn-primary py-2 px-4 bg-red' type='submit' id='noButton' name='noButton' style='border-radius: 25px 25px;'>No</button>&nbsp;&nbsp;&nbsp;
                                                                                            <button class='btn btn-primary py-2 px-4 bg-green' type='submit' id='yesButton' name='yesButton' style='border-radius: 25px 25px;'>Yes</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                        </div>
                                                    </div>";

                                                    // echo "<script>
                                                    //     // Get the modal
                                                    //     var modal1 = document.getElementById('myModal1');

                                                    //     // Get the button that opens the modal
                                                    //     var btn1 = document.getElementById('deleteprod');

                                                    //     // Get the <span> element that closes the modal
                                                    //     var span1 = document.getElementsByClassName('close')[1];

                                                    //     // When the user clicks the button, open the modal
                                                    //     btn1.onclick = function() {
                                                    //       modal1.style.display = 'block';
                                                    //     }

                                                    //     // When the user clicks on <span> (x), close the modal
                                                    //     span1.onclick = function() {
                                                    //       modal1.style.display = 'none';
                                                    //     }

                                                    //     // When the user clicks anywhere outside of the modal, close it
                                                    //     window.onclick = function(event) {
                                                    //       if (event.target == modal1) {
                                                    //         modal1.style.display = 'none';
                                                    //       }
                                                    //     }
                                                    // </script>";
                                                    
                                                }
                                            } 
                                        ?>

                                        <!-- <tr>
                                            <td class="align-middle"><img src="img/hp1.jpeg" alt="" style="width: 50px;"><br/>HP Chromebook 14</td>
                                            <td class="align-middle">15</td>
                                            <td class="align-middle">Tk. 32100.00</td>
                                            <td class="align-middle">
                                                <a href="detail.html"><button class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i></button></a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="editproduct.html"><button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="#"><button class="btn btn-sm btn-primary" type="submit" id="deleteprod"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr> -->        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product List End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- <script>
    // Get the modal
    var modal1 = document.getElementById("myModal1");

    // Get the button that opens the modal
    var btn1 = document.getElementById("deleteprod");

    // Get the <span> element that closes the modal
    var span1 = document.getElementsByClassName("close")[1];

    // When the user clicks the button, open the modal
    btn1.onclick = function() {
      modal1.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span1.onclick = function() {
      modal1.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal1) {
        modal1.style.display = "none";
      }
    }
    </script> -->
</body>

</html>