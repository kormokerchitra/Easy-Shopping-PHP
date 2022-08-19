<?php 

    $file_url = ""; $status = ""; $productImage=""; $url2="";
    $upload_path = 'img/';
 
    // //creating the upload url
    $upload_url = 'easy_shopping/admin/'.$upload_path;

    $itemCount=0;
    $totalProductInt=0;
    $cat_count=0;
    $isAddSuccess="false";

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/category_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $cat_list = $json_data["cat_list"];
    $total_count = count($cat_list);

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/product_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $product_list = $json_data["product_list"];
    $count = count($product_list);

    $date = time();

    if(isset($_POST['addProductName'])){
        $categoryId = $_POST['catId'];
        $productName = $_POST['productName'];
        $productCode = $_POST['productCode'];
        $productPrice = $_POST['productPrice'];
        $productDiscount = $_POST['productDiscount'];
        $productColor = $_POST['productColor'];
        $productDescription = $_POST['productDescription'];
        $productDimension = $_POST['productDimension'];
        $productSize = $_POST['productSize'];
        $shippingWeight = $_POST['shippingWeight'];
        $manufName = $_POST['manufName'];
        $prodSerialNum = $_POST['prodSerialNum'];
        $productStock = $_POST['productStock'];
        // $productImage = $_POST["productImage"];
        if(isset($_FILES['productImage'])){
            $errors= array();
            $file_name = $_FILES['productImage']['name'];
            $file_size = $_FILES['productImage']['size'];
            $file_tmp = $_FILES['productImage']['tmp_name'];
            $file_type = $_FILES['productImage']['type'];
            // $file_ext=strtolower(end(explode('.',$_FILES['productImage']['name'])));
          
            $extensions= array("jpeg","jpg","png");
            $date = time();
          
            // if(in_array($file_ext,$extensions)===false){
            //    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            // }
            // if($file_size > 2097152) {
            //    $errors[]='File size must be excately 2 MB';
            // }
          
           $file_url = $upload_path . $date . '.png';
           $productImage = $upload_url . $date . '.png';
           if(move_uploaded_file($file_tmp,$file_url)){
           }else{
           }
        }
        //   if($productImage!=""){
        //     //file url to store in the database
        //     $file_url = $upload_path . $date . '.png';

        //     //file path to upload in the server
        //     $file_path = $upload_path . $date . '.png';

        //     echo $file_url;

        //     try{
        //     //saving the file
        //     // $status = file_put_contents($file_path,base64_decode($productImage));
        //         if(file_put_contents($file_path,base64_decode($productImage))){
        //            echo "File up"; 
        //         }else{
        //             echo "File not up";
        //         }
        //     }catch(Exception $e){
        //         $response['error']=true;
        //         $response['message']=$e->getMessage();
        //     }
        // }

        $url2 = $base_url."easy_shopping/admin/product_add_web.php";
        $postdata = http_build_query(
            array(
                'cat_id' => $categoryId,
                'product_name' => $productName,
                'product_code' => $productCode,
                'product_price' => $productPrice,
                'prod_discount' => $productDiscount,
                'prod_color' => $productColor,
                'prod_description' => $productDescription,
                'prod_dimension' => $productDimension,
                'product_size' => $productSize,
                'shipping_weight' => $shippingWeight,
                'manuf_name' => $manufName,
                'prod_serial_num' => $prodSerialNum,
                'stock' => $productStock,
                'product_img' => $productImage,
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
        $isAddSuccess = "true";
        // header("Location: products.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $product_list = $json_data["product_list"];
        $count = count($product_list);
    }

    if($isAddSuccess == "true"){
        $url_category = $base_url."easy_shopping/category_list.php";
        $json_category = file_get_contents($url_category);
        $json_data_category = json_decode($json_category, true);

        $categoryId = $_POST['catId'];

        $cat_list = $json_data_category["cat_list"];
        $count = count($cat_list);
        for ($i=0; $i < $count; $i++) { 
            $cat_id = $cat_list[$i]["cat_id"];
            if($cat_id==$categoryId){
                $cat_count = $cat_list[$i]["product_count"];
                $cat_count++;
            }
        }

        $itemCount = $cat_count;
        $totalProductInt += $itemCount;

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
                <!-- Product Add Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Add Product</span></h2>
                        <?php
                            if($isAddSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Product added successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }
                        ?>
                    </div>
                    <div class="container-fluid pt-4">
                        <div class="row justify-content-center px-xl-5">
                            <div class="col-lg-10 mb-5">
                                <div class="contact-form">
                                    <div>
                                        <p class="text-primary">Here<span class="text-danger"> *</span> marked fields are mandatory.</p>
                                    </div>
                                    <div id="success"></div>
                                    <form name="productAdd" id="productForm" method="POST" action="" enctype="multipart/form-data">
                                        <div class="control-group">
                                            <label for="categorytname"><b>Category Name</b></label>
                                            <span class="text-danger">*</span><Br/>
                                            <select class="form-control" name="catId" id="catid" style="border-radius: 25px 25px;">
                                                <?php
                                                    for ($i=0; $i < $total_count; $i++) { 
                                                        $cat_id = $cat_list[$i]["cat_id"];
                                                        $name = $cat_list[$i]["cat_name"];
                                                        echo "<option value='$cat_id'>$name</option>";
                                                    }
                                                ?>
                                                <!-- <option value="1">Phone</option>
                                                <option value="2">Computer</option> -->
                                            </select>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productname"><b>Product Name</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productname" name="productName" placeholder="Enter product name..." required data-validation-required-message="Product name is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productcode"><b>Product Code</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productcode" name="productCode" placeholder="Enter product code..." required data-validation-required-message="Product code is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productprice"><b>Product Price</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productprice" name="productPrice" placeholder="Enter product price..." required data-validation-required-message="Product price is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productdiscount"><b>Product Discount</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productdiscount" name="productDiscount" placeholder="Enter product discount..." required data-validation-required-message="Product discount is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productcolor"><b>Product Color</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productcolor" name="productColor" placeholder="Enter product color..." required data-validation-required-message="Product color is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productdescription"><b>Product Description</b></label>
                                            <span class="text-danger">*</span>
                                            <textarea class="form-control" id="productdescription" name="productDescription" rows="3" placeholder="Enter product description..." required data-validation-required-message="Product description is required" style="border-radius: 25px 25px;"></textarea>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productdimension"><b>Product Dimension</b></label>
                                            <input type="text" class="form-control" id="productdimension" name="productDimension" placeholder="Enter product dimension..." style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productsize"><b>Product Size</b></label>
                                            <input type="text" class="form-control" id="productsize" name="productSize" placeholder="Enter product size..." style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="shippingweight"><b>Shipping Weight</b></label>
                                            <input type="text" class="form-control" id="shippingweight" name="shippingWeight" placeholder="Enter shipping weight..." style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="manufacturername"><b>Manufacturer Name</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="manufacturername" name="manufName" placeholder="Enter manufacturer name..." required data-validation-required-message="Manufacturer name is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="prodserialnum"><b>Product Serial Number</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="prodserialnum" name="prodSerialNum" placeholder="Enter product serial number..." required data-validation-required-message="Product serial number is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productstock"><b>Product Stock</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="productstock" name="productStock" placeholder="Enter product stock..." required data-validation-required-message="Product stock is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="productimage"><b>Product Image</b></label>
                                            <div class="imgcontainer">
                                                <img id="output" src="img/addimage.png" alt="Avatar" width="200" height="200" style="cursor: pointer;">
                                            </div>
                                            <input type="file" id="fileImg" name="productImage" placeholder="Select Image..." onchange="output.src=window.URL.createObjectURL(this.files[0])" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button class="btn btn-primary py-2 px-4" type="submit" name="addProductName" id="prodAddButton" style="border-radius: 25px 25px;">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Add End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

    <script>
        function preview() {
            output.src=URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>