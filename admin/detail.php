<?php

    $prod_id = ""; 
    $isDiscountEditSuccess="false";

    $base_url="http://localhost/";
    // $url = $base_url."easy_shopping/product_list.php";
    // $json = file_get_contents($url);
    // $json_data = json_decode($json, true);

    // $prod_id = $_GET['prod_id'];
    // $product_name = $_GET['product_name'];
    // $product_list = $json_data["product_list"];
    // $count = count($product_list);
    
    // $title_name = "";
    // if($product_name == ""){
    //     $title_name = "Product Details";
    // }else{
    //     $title_name = $product_name;
    // } 
    
    $jsonBody = $_GET['jsonBody'];
    $json_data = json_decode($jsonBody, true);
    $jsonEncode = json_encode($json_data);

    $prod_img = $json_data["product_img"];
    if($json_data["product_img"] == ""){
        $prod_img = 'img/product_back.jpg';
    }else{
        $prod_img = $base_url.$prod_img;
    }

    if(isset($_POST['editDiscountName'])){
        $discountNameEdit = $_POST['discountNameEdit'];
        $discountIDEdit = $_POST['discountIDEdit'];
         
        $url2 = $base_url."easy_shopping/product_status_edit.php";
        $postdata = http_build_query(
            array(
                'prod_discount' => $discountNameEdit,
                'prod_id' => $discountIDEdit,
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

        $response = file_get_contents($url2, false, $context);
        $isDiscountEditSuccess = "true";
        // header("Location: categorylist.php");
        $jsonBody = $_GET['jsonBody'];
        $json_data = json_decode($jsonBody, true);
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
                <div class="container-fluid pt-5">
                    <!-- <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Product Details</span></h2>
                    </div> -->
                    <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Product Details</h2>
                            <div>
                                <?php
                                   echo "<a href='editproduct.php?jsonBody=$jsonEncode'><button class='btn btn-primary py-2 px-4' type='submit' id='prodEdit'  style='border-radius: 25px 25px;'><i class='fa fa-edit'></i>&nbsp;&nbsp;Edit Product</button></a>";
                                ?>
                                <!-- <a href="editproduct.php?jsonBody=$jsonEncode"><button class="btn btn-primary py-2 px-4" type="submit" id="prodEdit"><i class="fa fa-edit"></i> Edit Product</button></a> --> 
                                <a href="#"><button class="btn btn-primary py-2 px-4" type="submit" id="discEdit" style="border-radius: 25px 25px;"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Discount</button></a>   
                            </div>
                        </div>
                        <?php
                            if($isDiscountEditSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Discount updated successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }
                        ?>
                    </div>
                    <!-- Shop Detail Start -->
                    <div class="container-fluid py-5">
                        <div class="row px-xl-10">
                            <div class="col-lg-5 pb-5">
                                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner border">
                                        <div class="carousel-item active">

                                            <?php 
                                                echo "<img class='w-100 h-100' src=$prod_img alt='Image'>";
                                            ?>
                                            
                                        </div>
                                        <!-- <div class="carousel-item">
                                            <img class="w-100 h-100" src="img/product-2.jpg" alt="Image">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="w-100 h-100" src="img/product-3.jpg" alt="Image">
                                        </div> -->
                                    </div>
                                    <!-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                                    </a>
                                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                                    </a> -->
                                </div>
                            </div>
                            <div class="col-lg-7 pb-5">
                                <h4 class="font-weight-semi-bold"><?php echo $json_data["product_name"]; ?></h4>
                                <div class="d-flex mb-3">
                                    <div class="text-primary mr-2">
                                        <small class="fas fa-star"></small>
                                        <!-- <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star-half-alt"></small>
                                        <small class="far fa-star"></small> -->
                                    </div>

                                    <?php 
                                        $reviewStr = "";
                                        $prod_rating = $json_data["prod_rating"];
                                        $rating_round = round($prod_rating, 2);
                                        $rating = sprintf('%.2f', $rating_round);
                                        if($prod_rating > 0){
                                            $reviewStr = $rating . " (" . $json_data["rev_count"] . " Reviews)";
                                        }else{
                                            $reviewStr = "No reviews";
                                        }
                                    ?>

                                    <small class="pt-1"><h6><?php echo $reviewStr; ?></h6></small>
                                </div>
                                <div>

                                    <?php 
                                        $discount_price=0; $amountStr=""; $product_size=""; $prod_dimension="";
                                        $prod_discount = $json_data["prod_discount"];
                                        $product_price = $json_data["product_price"];
                                        $product_size = $json_data["product_size"];
                                        $product_color = $json_data["prod_color"];
                                        $prod_dimension = $json_data["prod_dimension"];
                                        $shipping_weight = $json_data["shipping_weight"];
                                        //$prod_id = $json_data[$i]["prod_id"];

                                        $modalEditId = "myModalEdit".$prod_id;

                                        // Discount Edit Modal //
                                        echo "<div id='$modalEditId' class='modal'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <span class='close' onclick=document.getElementById('$modalEditId').style.display='none'>&times;</span>
                                                        <br/>
                                                        <div class='text-center mb-0 pt-4'>
                                                            <h4 class='section-title px-5'><span class='px-2'>Edit Product Discount</span></h4>
                                                        </div>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                                            <div class='row justify-content-center px-xl-5'>
                                                                <div class='col-lg-10 mb-5'>
                                                                    <div class='contact-form'>
                                                                        <div id='success'></div>
                                                                        <form name='editDiscount' id='editForm' method='POST' action=''>
                                                                            <div class='control-group'>
                                                                                <label for='editdisc'><b>Discount (%)</b></label>
                                                                                <span class='text-danger'>*</span>
                                                                                <input type='text' class='form-control' id='editdisc' placeholder='Enter discount...' required data-validation-required-message='Discount (%) is required' value='$prod_discount' name='discountNameEdit' style='border-radius: 25px 25px;' />
                                                                                <input type='hidden' value='$prod_id'  name='discountIDEdit' style='border-radius: 25px 25px;'/>
                                                                                <p class='help-block text-danger'></p>
                                                                            </div>
                                                                            <div class='row justify-content-center'>
                                                                                <button class='btn btn-primary py-2 px-4' type='submit' id='editdiscButton' name='editDiscountName' style='border-radius: 25px 25px;'>Edit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>        
                                                    </div>
                                                </div>
                                            </div>";

                                        if($prod_discount!=0){
                                            $discount_price = $product_price - ($product_price * ($prod_discount / 100));
                                            $disc_price = sprintf('%.2f', $discount_price);

                                            //$modalEditId = "myModalEdit".$prod_id;

                                            // Discount Edit Modal //
                                            // echo "<div id='$modalEditId' class='modal'>
                                            //     <div class='modal-content'>
                                            //         <div class='modal-header'>
                                            //             <span class='close' onclick=document.getElementById('$modalEditId').style.display='none'>&times;</span>
                                            //             <br/>
                                            //             <div class='text-center mb-4 pt-4'>
                                            //                 <h4 class='section-title px-5'><span class='px-2'>Edit Product Discount</span></h4>
                                            //             </div>
                                            //         </div>
                                            //         <div class='modal-body'>
                                            //             <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                            //                 <div class='row justify-content-center px-xl-5'>
                                            //                     <div class='col-lg-10 mb-5'>
                                            //                         <div class='contact-form'>
                                            //                             <div id='success'></div>
                                            //                             <form name='editDiscount' id='editForm' method='POST'>
                                            //                                 <div class='control-group'>
                                            //                                     <label for='editdisc'><b>Discount (%)</b></label>
                                            //                                     <span class='text-danger'>*</span>
                                            //                                     <input type='text' class='form-control' id='editdisc' placeholder='Enter discount...' required data-validation-required-message='Product discount (%) is required' value='$prod_discount' name='discountNameEdit' />
                                            //                                     <input type='hidden' value='$prod_id'  name='discountIDEdit'/>
                                            //                                     <p class='help-block text-danger'></p>
                                            //                                 </div>
                                            //                                 <div>
                                            //                                     <button class='btn btn-primary py-2 px-4' type='submit' id='editdiscButton' name = 'editDiscountName'>Edit</button>
                                            //                                 </div>
                                            //                             </form>
                                            //                         </div>
                                            //                     </div>
                                            //                 </div>
                                            //             </div>        
                                            //         </div>
                                            //     </div>
                                            // </div>";
                                        }

                                        if($discount_price != 0){
                                            $amountStr = "<h5 class='text-muted ml-2'><del>Tk. $product_price</del></h5>";

                                            $discountStr = "<h5 class='font-weight-semi-bold mb-4'>Tk. $disc_price ($prod_discount%)</h5>";
                                        }else{
                                            $amountStr = "<h5 class='font-weight-semi-bold mb-4'>Tk. $product_price</h5>";
                                            $discountStr = "";
                                        }

                                        echo $amountStr.$discountStr;

                                        if($product_size==""){
                                            $product_size = "N/A";
                                        }

                                        if($prod_dimension==""){
                                            $prod_dimension = "N/A";
                                        }

                                        if($shipping_weight==""){
                                            $shipping_weight = "N/A";
                                        }
                                    ?>
                                    
                                </div>
                                <div class="d-flex mb-3">
                                    <p class="text-dark font-weight-medium mb-0 mr-3">Product Code: <?php echo $json_data["product_code"]; ?></p>
                                    <!-- <form>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="size-1" name="size">
                                            <label class="custom-control-label" for="size-1">XS</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="size-2" name="size">
                                            <label class="custom-control-label" for="size-2">S</label>
                                        </div>
                                    </form> -->
                                </div>
                                <div class="d-flex mb-4">
                                    <p class="text-dark font-weight-medium mb-0 mr-3">Size: <?php echo $product_size; ?></p>
                                </div>
                                <div class="d-flex mb-4">
                                    <p class="text-dark font-weight-medium mb-0 mr-3">Color: <?php echo $product_color; ?></p>
                                </div>
                                <div class="d-flex mb-4">
                                    <p class="text-dark font-weight-medium mb-0 mr-3">Stock: <?php echo $json_data["prod_quantity"]; ?></p>
                                </div>
                                
                                <!-- <div class="d-flex pt-2">
                                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                                    <div class="d-inline-flex">
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-12">
                                    <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                                        <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab-pane-1">
                                            <h4 class="mb-3">Product Description</h4>
                                            <p><?php echo $json_data["prod_description"]; ?></p>
                                        </div>
                                        <div class="tab-pane fade" id="tab-pane-2">
                                            <h4 class="mb-3">Product Information</h4>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item px-0">
                                            Dimension:
                                                        </li>
                                                        <li class="list-group-item px-0">
                                            Shipping Weight:
                                                        </li>
                                                        <li class="list-group-item px-0">
                                            Manufacturer:
                                                        </li>
                                                        <li class="list-group-item px-0">
                                            SIN:
                                                        </li>
                                                    </ul> 
                                                </div>
                                                <div class="col-md-7">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item px-0">
                                           <?php echo $prod_dimension; ?>
                                                        </li>
                                                        <li class="list-group-item px-0">
                                            <?php echo $shipping_weight; ?>
                                                        </li>
                                                        <li class="list-group-item px-0">
                                            <?php echo $json_data["manuf_name"]; ?>
                                                        </li>
                                                        <li class="list-group-item px-0">
                                            <?php echo $json_data["prod_serial_num"]; ?>
                                                        </li>
                                                    </ul> 
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Detail End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End --> 

    <?php
        include "footer.php";
    ?>

    <!-- Discount Edit Modal -->
    <!-- <div id="myModalEdit" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <br/>
                <div class="text-center mb-4">
                    <h4 class="section-title px-5"><span class="px-2">Edit Product Discount</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 bg-whiteblue">
                    <div class="row justify-content-center px-xl-5">
                        <div class="col-lg-10 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="sentMessage" id="contactForm">
                                    <div class="control-group">
                                        <label for="editdisc"><b>Discount (%)</b></label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="editdisc" placeholder="Enter discount..." required data-validation-required-message="Product discount (%) is required" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary py-2 px-4" type="submit" id="editdiscButton">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div> -->

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
    <script>
    // Get the modal
    // var modal = document.getElementById("myModal");
    var modal1 = document.getElementById("myModalEdit");

    // Get the button that opens the modal
    // var btn = document.getElementById("logout");
    var btn1 = document.getElementById("discEdit");

    // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];
    var span1 = document.getElementsByClassName("close")[1];

    // When the user clicks the button, open the modal 
    // btn.onclick = function() {
    //   modal.style.display = "block";
    // }
    btn1.onclick = function() {
      modal1.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //   modal.style.display = "none";
    // }
    span1.onclick = function() {
      modal1.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal) {
    //     modal.style.display = "none";
    //   }
    // }
    window.onclick = function(event) {
      if (event.target == modal1) {
        modal1.style.display = "none";
      }
    }
    </script>
</body>

</html>