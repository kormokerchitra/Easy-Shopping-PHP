<?php  

    $url = "http://localhost/easy_shopping/dashboard_counter.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json);

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
                            <a href="dashboard.php" class="nav-item nav-link active"><i class="fas fa-folder"></i> Dashboard</a>
                            <a href="userlist.php" class="nav-item nav-link"><i class="fas fa-user-alt"></i> User List</a>
                            <a href="categorylist.php" class="nav-item nav-link"><i class="fas fa-shapes"></i> Category List</a>      
                            <a href="products.php?cat_id=&cat_name=" class="nav-item nav-link"><i class="fas fa-shopping-bag"></i> Product List</a>
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
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Dashboard</span></h2>
                    </div>
                    <!-- <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Dashboard</h2>
                        </div>
                    </div> -->
                    
                    <div class="container-fluid py-4">
                        <div class="col-lg-12 table-responsive mb-5" id="showCounter">
                            <table class="table text-center mb-0">
                                <tbody class="align-middle">
                                    <tr>
                                        <td class="align-middle">
                                            <div class="nav-profile-text d-flex flex-column bg-blue" style="border-radius: 50px 50px 50px 50px;">
                                            <br/>
                                                <a href="userlist.php" class="nav-item nav-link"><h5 class="font-weight-bold mb-2 text-white"><i class="fas fa-user-alt"></i> Total User</h5></a>
                                                <h7 class="text-white"><?php echo $json_data->user_count; ?> Users</h7>
                                                <br/>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="nav-profile-text d-flex flex-column bg-pink" style="border-radius: 50px 50px 50px 50px;">
                                            <br/>
                                                <a href="categorylist.php" class="nav-item nav-link"><h5 class="font-weight-bold mb-2 text-white"><i class="fas fa-shapes"></i> Total Categories</h5></a>
                                                <h7 class="text-white"><?php echo $json_data->category_count; ?> Categories</h7>
                                                <br/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="nav-profile-text d-flex flex-column bg-brown" style="border-radius: 50px 50px 50px 50px;">
                                            <br/>
                                                <a href="products.php?cat_id=&cat_name=" class="nav-item nav-link"><h5 class="font-weight-bold mb-2 text-white"><i class="fas fa-shopping-bag"></i> Total Products</h5></a>
                                                <h7 class="text-white"><?php echo $json_data->product_count; ?> Products</h7>
                                                <br/>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="nav-profile-text d-flex flex-column bg-green" style="border-radius: 50px 50px 50px 50px;">
                                            <br/>
                                                <a href="discountlist.php" class="nav-item nav-link"><h5 class="font-weight-bold mb-2 text-white"><i class="fa fa-list-alt"></i> Total Discount Products</h5></a>
                                                <h7 class="text-white"><?php echo $json_data->discount_count; ?> Products</h7>
                                                <br/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="nav-profile-text d-flex flex-column bg-orange" style="border-radius: 50px 50px 50px 50px;">
                                            <br/>
                                                <a href="couponlist.php" class="nav-item nav-link"><h5 class="font-weight-bold mb-2 text-white"><i class="fa fa-gift"></i> Total Vouchers/Coupons</h5></a>
                                                <h7 class="text-white"><?php echo $json_data->voucher_count; ?> Coupons</h7>
                                                <br/>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="nav-profile-text d-flex flex-column bg-purple" style="border-radius: 50px 50px 50px 50px;">
                                            <br/>
                                                <a href="orderlist.php" class="nav-item nav-link"><h5 class="font-weight-bold mb-2 text-white"><i class="fas fa-cart-plus"></i> Total Orders</h5></a>
                                                <h7 class="text-white"><?php echo $json_data->order_count; ?> Orders</h7>
                                                <br/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="nav-profile-text d-flex flex-column bg-darkash" style="border-radius: 50px 50px 50px 50px;">
                                            <br/>
                                                <a href="reviewlist.php" class="nav-item nav-link"><h5 class="font-weight-bold mb-2 text-white"><i class="fas fa-star"></i> Total Reviews</h5></a>
                                                <h7 class="text-white"><?php echo $json_data->review_count; ?> Reviews</h7>
                                                <br/>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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