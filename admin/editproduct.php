<?php

    // $prod_id = "";
    // $isEditSuccess="false";

    $base_url="http://localhost/";

    $jsonBody = $_GET['jsonBody'];
    $json_data = json_decode($jsonBody, true);

    $cat_name = $json_data["cat_name"];
    $product_name = $json_data["product_name"];
    $product_code = $json_data["product_code"];
    $product_price = $json_data["product_price"];
    $product_color = $json_data["prod_color"];
    $prod_description = $json_data["prod_description"];
    $prod_dimension = $json_data["prod_dimension"];
    $product_size = $json_data["product_size"];
    $shipping_weight = $json_data["shipping_weight"];
    $manuf_name = $json_data["manuf_name"];
    $prod_serial_num = $json_data["prod_serial_num"];
    $stock = $json_data["prod_quantity"];
    $prod_img = $json_data["product_img"];
    if($json_data["product_img"] == ""){
        $prod_img = 'img/addimage.png';
    }else{
        $prod_img = $base_url.$prod_img;
    }
    // echo $product_name;

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/category_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $cat_list = $json_data["cat_list"];
    $total_count = count($cat_list);

    // $base_url="http://localhost/";
    // $url = $base_url."easy_shopping/product_list.php";
    // $json = file_get_contents($url);
    // $json_data = json_decode($json, true);

    // $product_list = $json_data["product_list"];
    // $count = count($product_list);

    if(isset($_POST['editProductName'])){
        $categoryIdEdit = $_POST['catIdEdit'];
        $productNameEdit = $_POST['productNameEdit'];
        $productCodeEdit = $_POST['productCodeEdit'];
        $productPriceEdit = $_POST['productPriceEdit'];
        //$productDiscountEdit = $_POST['productDiscountEdit'];
        $productColorEdit = $_POST['productColorEdit'];
        $productDescriptionEdit = $_POST['productDescriptionEdit'];
        $productDimensionEdit = $_POST['productDimensionEdit'];
        $productSizeEdit = $_POST['productSizeEdit'];
        $shippingWeightEdit = $_POST['shippingWeightEdit'];
        $manufNameEdit = $_POST['manufNameEdit'];
        $prodSerialNumEdit = $_POST['prodSerialNumEdit'];
        $productStockEdit = $_POST['productStockEdit'];
        $productImageEdit = $_POST['productImageEdit'];
        $productIDEdit = $_POST['productIDEdit'];

        $url2 = $base_url."easy_shopping/product_edit.php";
        $postdata = http_build_query(
            array(
                'cat_id' => $categoryIdEdit,
                'product_name' => $productNameEdit,
                'product_code' => $productCodeEdit,
                'product_price' => $productPriceEdit,
                //'prod_discount' => $productDiscountEdit,
                'prod_color' => $productColorEdit,
                'prod_description' => $productDescriptionEdit,
                'prod_dimension' => $productDimensionEdit,
                'product_size' => $productSizeEdit,
                'shipping_weight' => $shippingWeightEdit,
                'manuf_name' => $manufNameEdit,
                'prod_serial_num' => $prodSerialNumEdit,
                'stock' => $productStockEdit,
                'product_img' => $productImageEdit,
                'prod_id' => $productIDEdit,
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
        $isEditSuccess = "true";
        // header("Location: products.php");
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
                <!-- Product Edit Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Edit Product</span></h2>
                        <!-- <?php
                            // if($isEditSuccess == "true"){
                            //     echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                            //         <i class='bi-check-circle-fill'></i>
                            //         <strong class='mx-4'>Success!</strong> Product edited successfully.
                            //         <button type='button' class='close' data-dismiss='alert' aria-label=
                            //         'Close'><span aria-hidden='true'>&times;</span></button>
                            //     </div>";    
                            // }
                        ?> --> 
                    </div>
                    <!-- <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Edit Product</h2>
                        </div>
                    </div> -->
                    <div class="container-fluid pt-4">
                        <div class="row justify-content-center px-xl-5">
                            <div class="col-lg-10 mb-5">
                                <div class="contact-form">
                                    <div>
                                        <p class="text-primary">Here<span class="text-danger"> *</span> marked fields are mandatory.</p>
                                    </div>
                                    <div id="success"></div>
                                    <form name="editProduct" id="editForm" action="" method="POST">
                                        <div class="control-group">
                                            <label for="categoryname"><b>Category Name</b></label>
                                            <span class="text-danger">*</span><Br/>
                                            <select class="form-control" name="cat" id="cat" style="border-radius: 25px 25px;">
                                                <?php
                                                    for ($i=0; $i < $total_count; $i++) { 
                                                        $cat_id = $cat_list[$i]["cat_id"];
                                                        $name = $cat_list[$i]["cat_name"];
                                                        if($name == $cat_name){
                                                            echo "<option value='$cat_id' selected>$name</option>";
                                                        }else{
                                                            echo "<option value='$cat_id'>$name</option>";
                                                        }   
                                                    }
                                                ?>
                                            </select>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productname"><b>Product Name</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productname" placeholder="Enter product name..." required value="<?php echo $product_name; ?>" name="productNameEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" class="form-control" id="productname" placeholder="Enter product name..." required value="<?php echo $cat_id; ?>" name="catIdEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productcode"><b>Product Code</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productcode" placeholder="Enter product code..." required value="<?php echo $product_code; ?>" name="productCodeEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productprice"><b>Product Price</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productprice" placeholder="Enter product price..." required value="<?php echo $product_price; ?>" name="productPriceEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productcolor"><b>Product Color</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productcolor" placeholder="Enter product color..." required value="<?php echo $product_color; ?>" name="productColorEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productdescription"><b>Product Description</b></label>
                                            <span class="text-danger">*</span>
                                            <textarea id="productdescription" rows="3" class="form-control" placeholder="Enter product description..." required value="" name="productDescriptionEdit" style="border-radius: 25px 25px;"><?php echo $prod_description; ?></textarea>
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <!-- <div class="control-group">
                                            <label for="productdescription"><b>Product Description</b></label>
                                            <input type="text" class="form-control" id="productdescription" placeholder="Enter product description..." required="required" data-validation-required-message="Please enter product description" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productdiscount"><b>Product Discount</b></label>
                                            <input type="text" class="form-control" id="productdiscount" placeholder="10"/>
                                            <p class="help-block text-danger"></p>
                                        </div> -->
                                        <div class="control-group">
                                            <label for="productdimension"><b>Product Dimension</b></label>
                                            <input type="text" class="form-control" id="productdimension" placeholder="Enter product dimension..." value="<?php echo $prod_dimension; ?>" name="productDimensionEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productsize"><b>Product Size</b></label>
                                            <input type="text" class="form-control" id="productsize" placeholder="Enter product size..." value="<?php echo $product_size; ?>" name="productSizeEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="shippingweight"><b>Shipping Weight</b></label>
                                            <input type="text" class="form-control" id="shippingweight" placeholder="Enter product shipping weight..." value="<?php echo $shipping_weight; ?>" name="shippingWeightEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="manufacturername"><b>Manufacturer Name</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="manufacturername" placeholder="Enter manufacturer name..." required value="<?php echo $manuf_name; ?>" name="manufNameEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="prodserialnum"><b>Product Serial Number</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="prodserialnum" placeholder="Enter product serial number..." required value="<?php echo $prod_serial_num; ?>" name="prodSerialNumEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productstock"><b>Product Stock</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productstock" placeholder="Enter product stock..." required value="<?php echo $stock; ?>" name="productStockEdit" style="border-radius: 25px 25px;" />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productimage"><b>Product Image</b></label>
                                            <div class="imgcontainer">
                                                <?php 
                                                    echo "<img src='$prod_img' alt='Avatar' width='250' height='250'>"; 
                                                ?>
                                                <!-- <img src="img/addimage.png" alt="Avatar" width="200" height="200"> -->
                                            </div>
                                            <input type="file" id="fileImg" name="productImageEdit" placeholder="Select Image..." />
                                            <input type="hidden" value="$prod_id" name="productIDEdit" />
                                            <p class="help-block text-danger"></p>
                                        </div>


                                        <!-- <div class="control-group">
                                            <label for="productimage"><b>Product Image</b></label>
                                            <div class="imgcontainer">
                                                <img id="output" src="img/addimage.png" alt="Avatar" width="200" height="200" style="cursor: pointer;">
                                            </div>
                                            <input type="file" id="fileImg" name="productImage" placeholder="Select Image..." onchange="output.src=window.URL.createObjectURL(this.files[0])" />
                                            <p class="help-block text-danger"></p>
                                        </div> -->


                                        <div class="row justify-content-center">
                                            <button class="btn btn-primary py-2 px-4" type="submit" id="prodEditButton" name="editProductName" style="border-radius: 25px 25px;">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Edit End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

</body>

</html>