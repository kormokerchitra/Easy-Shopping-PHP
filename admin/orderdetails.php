<?php  

    $jsonBody = $_GET['jsonBody'];
    $json_data = json_decode($jsonBody, true);
    $phone = $json_data["phon_number"];
    $phone_size = strlen($phone);

    session_start();

    $login_user = $_SESSION['user_id'];
    
    if($phone[1] == "8"){
        $phone = "+".$phone;
    }
    
    $order_id = $json_data["order_id"];
    $inv_id = $json_data["inv_id"];
    $receiver = $json_data["user_id"];

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/order_product_by_id.php";

    $postdata = http_build_query(
        array(
            'order_id' => $order_id,
            'user_id' => ''
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
    $json = file_get_contents($url, false, $context);
    $json_data_product = json_decode($json, true);

    $product_list = $json_data_product["list"];
    $count = count($product_list);

    $dropdownId="";
    if(isset($_POST['submit'])) {
        $dropdownId = $_POST['editstatus'];

        $url1 = $base_url."easy_shopping/order_status_edit.php";

        $postdata1 = http_build_query(
            array(
                'order_id' => $order_id,
                'status' => $dropdownId
            )
        );

        $opts1 = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata1
            )
        );
        $context1 = stream_context_create($opts1);
        $response = file_get_contents($url1, false, $context1);

        $json_data["status"] = $dropdownId;

        $url3 = $base_url."easy_shopping/notification_update.php";

        $postdata3 = http_build_query(
            array(
                'inv_id' => $inv_id,
                'status' => $dropdownId,
                'receiver' => $receiver,
                'sender' => $login_user
            )
        );

        $opts3 = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata3
            )
        );
        $context3 = stream_context_create($opts3);
        $response = file_get_contents($url3, false, $context3);

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
                            <a href="products.php?cat_id=&cat_name=" class="nav-item nav-link"><i class="fas fa-shopping-bag"></i> Product List</a>
                            <a href="discountlist.php" class="nav-item nav-link"><i class="fa fa-list-alt"></i> Discount List</a>
                            <a href="orderlist.php" class="nav-item nav-link active"><i class="fas fa-cart-plus"></i> Order List</a>
                            <a href="couponlist.php" class="nav-item nav-link"><i class="fa fa-gift"></i> Voucher/Coupon List</a>
                            <a href="reviewlist.php" class="nav-item nav-link"><i class="fas fa-star"></i> Review List</a>
                            <a href="profile.php" class="nav-item nav-link"><i class="fas fa-user-circle"></i> Profile</a>
                        </div>
                    </nav>
                </nav>
            </div>
            <!-- Order Details Start -->
            <div class="col-lg-9">
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Order Details</h2>
                            <div>
                                <a href="#"><button class="btn btn-primary py-2 px-4 myModal" type="submit" id="changestatus" style="border-radius: 25px 25px;"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo $json_data["status"]; ?></button></a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Order Details</span></h2>
                    </div> -->
                    <div class="container-fluid pt-4">
                        <div class="row px-xl-10">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h4 class="font-weight-semi-bold mb-4">Delivering Address</h4>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label><b>Full Name</b></label>
                                            <br/>
                                            <label class="form-control" style="border-radius: 25px 25px;"><?php echo $json_data["full_name"]; ?></label>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label><b>Address</b></label>
                                            <br/>
                                            <label class="form-control" style="border-radius: 25px 25px;"><?php echo $json_data["address"]; ?> </label>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label><b>Mobile No</b></label>
                                            <br/>
                                            <label class="form-control" style="border-radius: 25px 25px;"><?php echo $phone; ?> </label>
                                        </div>
                                        <div class="col-lg-12 form-group">
                                            <label><b>Delivery Date</b></label>
                                            <br/>
                                            <label class="form-control" style="border-radius: 25px 25px;"><?php echo $json_data["delivery_date"]; ?> </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card border-secondary mb-3">
                                    <div class="card-header bg-primary border-0">
                                        <h4 class="font-weight-semi-bold m-0">Shopping Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="font-weight-medium mb-3">Products</h5>
                                        
                                        <?php
                                            for ($i=0; $i < $count; $i++) { 
                                                $discount_price=0; $total=0; $total_price=0; $prod_qty=0;
                                                $prod_name = $product_list[$i]["product_name"];
                                                $prod_count = $product_list[$i]["product_count"];
                                                $product_price = $product_list[$i]["product_price"];
                                                $prod_discount = $product_list[$i]["prod_discount"];

                                                if($prod_discount!=0){
                                                    $discount_price = $product_price * ($prod_discount / 100);
                                                }

                                                $disc_sub_price = $product_price - $discount_price;
                                                $discount_price = sprintf('%.2f', $disc_sub_price);

                                                // $total = $prod_count * $product_price;
                                                // $total_price += $total;
                                                // $prod_qty += $prod_count;

                                                echo "<div class='d-flex justify-content-between'>
                                                    <p>$prod_name</p>
                                                    <p>$prod_count X Tk. $discount_price</p>
                                                </div>";
                                            }
                                        ?>
                                        
                                        <!-- <div class="d-flex justify-content-between">
                                            <p>HP Chromebook14 2</p>
                                            <p>3 X Tk. 150000</p>
                                        </div> -->
                                            <hr class="mt-0">
                                                <div class="d-flex justify-content-between mb-3 pt-1">
                                                    <h6 class="font-weight-medium">Invoice Id</h6>
                                                    <h6 class="font-weight-medium">#<?php echo $json_data["inv_id"]; ?></h6>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3 pt-1">
                                                    <h6 class="font-weight-medium">Total Products</h6>
                                                    <h6 class="font-weight-medium"><?php echo $json_data["total_product"]; ?></h6>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3 pt-1">
                                                    <h6 class="font-weight-medium">Total Price</h6>
                                                    <h6 class="font-weight-medium">Tk. <?php echo sprintf('%.2f', $json_data["total_price"]); ?></h6>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3 pt-1">
                                                    <h6 class="font-weight-medium">Discount</h6>
                                                    <h6 class="font-weight-medium">- Tk. <?php echo sprintf('%.2f', $json_data["prod_discount"]); ?></h6>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3 pt-1">
                                                    <h6 class="font-weight-medium">Sub Total</h6>
                                                    <h6 class="font-weight-medium">Tk. <?php echo sprintf('%.2f', $json_data["sub_total"]); ?></h6>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3 pt-1">
                                                    <h6 class="font-weight-medium">Coupon Discount</h6>
                                                    <h6 class="font-weight-medium">- Tk. <?php echo sprintf('%.2f', $json_data["coupon_discount"]); ?></h6>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="font-weight-medium">Shipping Cost</h6>
                                                    <h6 class="font-weight-medium">Tk. <?php echo sprintf('%.2f', $json_data["shipping_cost"]); ?></h6>
                                                </div>
                                            </div>
                                            <div class="card-footer border-secondary bg-secondary">
                                                <div class="d-flex justify-content-between mt-2">
                                                    <h5 class="font-weight-bold">Total Payable</h5>
                                                    <h5 class="font-weight-bold">Tk. <?php echo sprintf('%.2f', $json_data["total_payable"]); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border-secondary mb-5">
                                            <div class="card-header bg-primary border-0">
                                                <h4 class="font-weight-semi-bold m-0">Payment Method</h4>
                                            </div>
                                            <div class="card-body">

                                                <?php
                                                    $address = $json_data["address"];
                                                    $phone = $json_data["phon_number"];
                                                    if($json_data["payment_method"] == "Cash" || $json_data["payment_method"] == "cash"){
                                                        echo "<div class='form-group'>
                                                            <div class='custom-control custom-radio'>
                                                                <label class='custom-control-label' for='directcheck'>Cash on delivery</label>
                                                                <p class='mb-2'><i class='fa fa-map-marker-alt text-primary mr-3'></i>$address</p>
                                                            </div>
                                                        </div>";
                                                    }else{
                                                        echo "<div class='form-group'>
                                                            <div class='custom-control custom-radio'>
                                                                <label class='custom-control-label' for='bkash'>Bkash Payment</label>
                                                                <p class='mb-0'><i class='fa fa-credit-card text-primary mr-3'></i>$phone</p>
                                                            </div>
                                                        </div>";
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Details End -->
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

    <!-- Status Change Modal -->
    <div id="myModal1" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <br/>
                <div class="text-center mb-0 pt-4">
                    <h4 class="section-title px-5"><span class="px-2">Change Status</span></h4>
                </div>
                <!-- <h5 class="font-weight-bold text-dark mb-4">Change Status</h5> -->
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 py-0 bg-whiteblue">
                    <div class="row justify-content-center px-xl-5">
                        <div class="col-lg-9 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="sentMessage" id="contactForm" method="POST">
                                    <div class="control-group">
                                        <label for="editstatus"><b>Select status</b></label>
                                        <span class="text-danger">*</span><Br/>

                                        <?php 
                                            echo "<select class='form-control' name='editstatus' id='editstatus' style='border-radius: 25px 25px;'>";
                                            
                                                if($json_data["status"] == "New"){
                                                    echo "<option value='New' selected='true'>New</option>
                                                        <option value='Processing'>Processing</option>
                                                        <option value='Picked'>Picked</option>
                                                        <option value='Shipped'>Shipped</option>
                                                        <option value='Delivered'>Delivered</option>
                                                        <option value='Cancelled'>Cancelled</option>";
                                                }else if($json_data["status"] == "Processing"){
                                                    echo "<option value='New'>New</option>
                                                        <option value='Processing' selected='true'>Processing</option>
                                                        <option value='Picked'>Picked</option>
                                                        <option value='Shipped'>Shipped</option>
                                                        <option value='Delivered'>Delivered</option>
                                                        <option value='Cancelled'>Cancelled</option>";
                                                }else if($json_data["status"] == "Picked"){
                                                    echo "<option value='New'>New</option>
                                                        <option value='Processing'>Processing</option>
                                                        <option value='Picked' selected='true'>Picked</option>
                                                        <option value='Shipped'>Shipped</option>
                                                        <option value='Delivered'>Delivered</option>
                                                        <option value='Cancelled'>Cancelled</option>";
                                                }else if($json_data["status"] == "Shipped"){
                                                    echo "<option value='New'>New</option>
                                                        <option value='Processing'>Processing</option>
                                                        <option value='Picked'>Picked</option>
                                                        <option value='Shipped' selected='true'>Shipped</option>
                                                        <option value='Delivered'>Delivered</option>
                                                        <option value='Cancelled'>Cancelled</option>";
                                                }else if($json_data["status"] == "Delivered"){
                                                    echo "<option value='New'>New</option>
                                                        <option value='Processing'>Processing</option>
                                                        <option value='Picked'>Picked</option>
                                                        <option value='Shipped'>Shipped</option>
                                                        <option value='Delivered' selected='true'>Delivered</option>
                                                        <option value='Cancelled'>Cancelled</option>";
                                                }else if($json_data["status"] == "Cancelled"){
                                                    echo "<option value='New'>New</option>
                                                        <option value='Processing'>Processing</option>
                                                        <option value='Picked'>Picked</option>
                                                        <option value='Shipped'>Shipped</option>
                                                        <option value='Delivered'>Delivered</option>
                                                        <option value='Cancelled' selected='true'>Cancelled</option>";
                                                }
                                            echo "</select>";
                                        ?>       
                                        
                                    </div><Br/>
                                    <div class="row justify-content-center">
                                        <button class="btn btn-primary py-2 px-4" name="submit" type="submit" id="statusButton" style="border-radius: 25px 25px;">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>

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
    var modal1 = document.getElementById("myModal1");

    // Get the button that opens the modal
    var btn1 = document.getElementById("changestatus");

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
    </script>
</body>

</html>