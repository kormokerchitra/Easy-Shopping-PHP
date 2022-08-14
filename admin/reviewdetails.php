<?php

    $cat_id = $_GET['cat_id'];
    $prod_id = $_GET['prod_id'];
    $product_name = $_GET['product_name'];
    $prod_rating = $_GET['prod_rating'];

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/review_list.php";

    $postdata = http_build_query(
        array(
            'prod_id' => $prod_id,
            'cat_id' => $cat_id
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
    $json_data = json_decode($json, true);

    $review_list = $json_data["list"];
    $count = count($review_list);
    
    $title_name = ""; 
    if($product_name == ""){
        $title_name = "Product List";
    }else{
        $title_name = $product_name;
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
                            <a href="orderlist.php" class="nav-item nav-link"><i class="fas fa-cart-plus"></i> Order List</a>
                            <a href="couponlist.php" class="nav-item nav-link"><i class="fa fa-gift"></i> Voucher/Coupon List</a>
                            <a href="reviewlist.php" class="nav-item nav-link active"><i class="fas fa-star"></i> Review List</a>
                            <a href="profile.php" class="nav-item nav-link"><i class="fas fa-user-circle"></i> Profile</a>
                        </div>
                    </nav>
                </nav>
            </div>
            <div class="col-lg-9">
                <!-- Review Details List Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Review Details</span></h2>
                    </div>
                    <div class="container-fluid pt-4">
                        <div class="row px-xl-10">
                            <h4 class="font-weight-bold text-dark mb-4"><?php echo $title_name." (<i class='fas fa-star text-primary'></i> ".$prod_rating.")"; ?></h4>
                            <div class="col-lg-12 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-primary text-dark">
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Full Name</th>
                                            <th>Rating</th>
                                            <th>Review Comment</th>
                                            <th>Date</th>
                                            <!-- <th>Reply</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                        <?php
                                            $sum=0;
                                            for ($i=0; $i < $count; $i++) { 
                                                $prodID = $review_list[$i]["prod_id"];
                                                $user_name = $review_list[$i]["full_name"];
                                                $prod_rating = $review_list[$i]["rating"];
                                                $rating_round = round($prod_rating, 2);
                                                $rating = sprintf('%.2f', $rating_round);
                                                $reviews = $review_list[$i]["reviews"];
                                                $cus_review = "";
                                                if($reviews == ""){
                                                    $cus_review = "--";
                                                } else{
                                                    $cus_review = $reviews;
                                                }           
                                                $date = $review_list[$i]["date"];

                                                // Review List Show for Specific Product //
                                                if($prod_id != "" && $prod_id == $prodID){
                                                    $sum=$sum+1;
                                                    echo "<tr>
                                                        <td class='align-middle'>$sum.</td>
                                                        <td class='align-middle'>$user_name</td>
                                                        <td class='align-middle'><i class='fas fa-star text-primary'></i> $rating</td>
                                                        <td class='align-middle'>$cus_review</td>
                                                        <td class='align-middle'>$date</td>
                                                    </tr>";
                                                }
                                            }
                                        ?>
                                        
                                        <!-- <tr>
                                            <td class="align-middle">1</td>
                                            <td class="align-middle">Chitra Kormoker</td>
                                            <td class="align-middle"><i class="fas fa-star text-primary"></i> 4.1</td>
                                            <td class="align-middle">Good Product.</td>
                                            <td class="align-middle">03-05-2022</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Review Details List End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

</body>

</html>