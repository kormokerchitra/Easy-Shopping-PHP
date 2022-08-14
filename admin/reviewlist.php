<?php  

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/product_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $product_list = $json_data["product_list"];
    $count = count($product_list);

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
                            <a href="reviewlist.php" class="nav-item nav-link active"><i class="fas fa-star"></i> Review List</a>
                            <a href="profile.php" class="nav-item nav-link"><i class="fas fa-user-circle"></i> Profile</a>
                        </div>
                    </nav>
                </nav>
            </div>
            <div class="col-lg-9">
                <!-- Review List Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Review List</span></h2>
                    </div>
                    <!-- <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Review List</h2>
                        </div>
                    </div> -->
                    <div class="container-fluid pt-4">
                        <div class="row px-xl-10">
                            <div class="col-lg-12 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-primary text-dark">
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Total Ratings</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                        <?php 
                                            $sum=0;
                                            for ($i=0; $i < $count; $i++) { 
                                                $prod_id = $product_list[$i]["prod_id"];
                                                $img =$base_url.$product_list[$i]["product_img"];
                                                $product_name = $product_list[$i]["product_name"];
                                                $cat_id = $product_list[$i]["cat_id"];
                                                $cat_name = $product_list[$i]["cat_name"];
                                                $prod_rating = $product_list[$i]["prod_rating"];
                                                $rating_round = round($prod_rating, 2);
                                                $rating = sprintf('%.2f', $rating_round);
                                                $rev_count = $product_list[$i]["rev_count"];

                                                if($product_list[$i]["product_img"]==""){
                                                    $img = 'img/hp1.jpeg';
                                                }

                                                // Review List Show //
                                                if($prod_rating>0){
                                                    $sum=$sum+1;
                                                    echo "<tr>
                                                        <td class='align-middle'>$sum.</td>
                                                        <td class='align-middle'><img src=$img alt='' style='width: 50px;'><Br/>$product_name</td>
                                                        <td class='align-middle'>$cat_name</td>
                                                        <td class='align-middle'><i class='fas fa-star text-primary'></i> $rating ($rev_count)</td>
                                                        <td class='align-middle'>
                                                            <a href='reviewdetails.php?prod_id=$prod_id&cat_id=$cat_id&product_name=$product_name&prod_rating=$rating'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-info-circle'></i></button></a>
                                                        </td>
                                                    </tr>";
                                                }
                                            }
                                        ?>

                                        <!-- <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle"><img src="img/hp1.jpeg" alt="" style="width: 50px;"><Br/>HP Chromebook 14</td>
                                            <td class="align-middle">Computer</td>
                                            <td class="align-middle"><i class="fas fa-star text-primary"></i> 4.5 (10)</td>
                                            <td class="align-middle">
                                                <a href="reviewdetails.html"><button class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i></button></a>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Review List End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

</body>

</html>