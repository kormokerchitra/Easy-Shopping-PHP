<?php
    $user_id=""; $name=""; $email="";$address="";$phone="";$username="";
    
    session_start();

    $base_url="http://localhost/";

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        $url = $base_url."easy_shopping/user_get.php";
        $postdata = http_build_query(
            array(
                'user_id' => $user_id,
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

        $response = file_get_contents($url, false, $context);

        $json_data = json_decode($response, true);

        $user_info = $json_data["user_info"];

        $name = $user_info[0]["full_name"];
        $address = $user_info[0]["address"];
        $email = $user_info[0]["email"];
        $phone = $user_info[0]["phone_num"];
        $username = $user_info[0]["username"];
    }

    if (isset($_POST['userUpdateBtn'])) {
            
        $emailuser = $_POST['emailuser'];
        $phoneuser = $_POST['phoneuser'];

        $url2 = $base_url."easy_shopping/user_edit.php";
        
        $postdata = http_build_query(
            array(
                'user_id' => $user_id,
                'image' => "",
                'full_name' => $name,
                'address' => $address,
                'email' => $emailuser,
                'phone_num' => $phoneuser,
                'username' => $username,
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

        $response2 = file_get_contents($url2, false, $context);

        if($response!="failure"){
            header("Location: profile.php");
        }
    }

    // if (isset($_POST['passwordUpdateBtn'])) {
            
    //     $pass_update = $_POST['pass_update'];

    //     $url3 = $base_url."easy_shopping/user_pass_update.php";
        
    //     $postdata = http_build_query(
    //         array(
    //             'user_id' => $user_id,
    //             'password' => $pass_update,
    //         )
    //     );

    //     $opts = array('http' =>
    //         array(
    //             'method' => 'POST',
    //             'header' => 'Content-type: application/x-www-form-urlencoded',
    //             'content' => $postdata
    //         )
    //     );
    //     $context = stream_context_create($opts);

    //     $response3 = file_get_contents($url3, false, $context);

    //     if($response!="failure"){
    //         header("Location: profile.php");
    //     }
    // }

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
                            <a href="orderlist.php" class="nav-item nav-link"><i class="fas fa-cart-plus"></i> Order List</a>
                            <a href="couponlist.php" class="nav-item nav-link"><i class="fa fa-gift"></i> Voucher/Coupon List</a>
                            <a href="reviewlist.php" class="nav-item nav-link"><i class="fas fa-star"></i> Review List</a>
                            <a href="profile.php" class="nav-item nav-link active"><i class="fas fa-user-circle"></i> Profile</a>
                        </div>
                    </nav>
                </nav> 
            </div>
            <div class="col-lg-9">
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">My Profile</span></h2>
                    </div>
                    <!-- <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Dashboard</h2>
                        </div>
                    </div> -->
                    <div class="container-fluid py-4">
                        <div class="row justify-content-center px-xl-4">
                            <div class="col-lg-8 mb-5">
                                <div class="contact-form">
                                    <div id="success"></div>
                                    <form name="profileEdit" id="profileForm" method="POST" action="">
                                        <div class="control-group">
                                            <!-- <label for="fullname"><b>Full Name</b></label>
                                            <input type="text" class="form-control" id="fullname" placeholder="Enter your full name..." />
                                            <p class="help-block text-danger"></p> -->
                                            <label><b>Full Name</b></label>
                                            <br/>
                                            <label class="form-control" style="border-radius: 25px 25px;"><?php echo $name; ?></label>
                                        </div>
                                        <div class="control-group">
                                            <!-- <label for="address"><b>Address</b></label>
                                            <input type="text" class="form-control" id="address" placeholder="Enter your address..." />
                                            <p class="help-block text-danger"></p> -->
                                            <label><b>Address</b></label>
                                            <br/>
                                            <label class="form-control" style="border-radius: 25px 25px;"><?php echo $address; ?></label>
                                        </div>
                                        <div class="control-group">
                                            <label for="email"><b>Email</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="email" value = "<?php echo $email; ?>" placeholder="Enter your email..." name = "emailuser" required data-validation-required-message="Email is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="phonenum"><b>Phone Number</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="phonenum" value = "<?php echo $phone; ?>"placeholder="Enter your phone number..." name="phoneuser" required data-validation-required-message="Phone number is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button class="btn btn-primary py-2 px-4" type="submit" id="infoupdateButton" name="userUpdateBtn" style="border-radius: 25px 25px;">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center px-xl-4">
                            <h4 class="font-weight-semi-bold">Update Password</h4>
                        </div><Br/>
                        <div class="row justify-content-center px-xl-4">
                            <div class="col-lg-8 mb-5">
                                <div class="contact-form">
                                    <div id="success"></div>
                                    <form name="passwordEdit" id="passwordForm" method="POST" action="">
                                        <div class="control-group">
                                            <label for="newpass"><b>New Password</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="newpass" name="pass_update" placeholder="Enter your new password..." required data-validation-required-message="New password is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="conpass"><b>Confirm Password</b></label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="conpass" name="pass_update" placeholder="Enter your confirm password... " required data-validation-required-message="Confirm password is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button class="btn btn-primary py-2 px-4" type="submit" id="passupdateButton" name="passwordUpdateBtn" style="border-radius: 25px 25px;">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

</body>

</html>