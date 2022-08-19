<?php 

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/order_list_all.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $order_list = $json_data["order_list"];
    $count = count($order_list);

    $processingCount=0; 
    $pickedCount=0;
    $shippedCount=0;
    $deliveredCount=0;
    $cancelledCount=0;
    $inv_id = "";

    if(isset($_GET["inv_id"])){
        $inv_id = $_GET["inv_id"];
    }

    for ($i=0; $i < $count; $i++){
        if($order_list[$i]["status"] == "Processing"){
            $processingCount++;
        }else if($order_list[$i]["status"] == "Picked"){
            $pickedCount++;
        }else if($order_list[$i]["status"] == "Shipped"){
            $shippedCount++;
        }else if($order_list[$i]["status"] == "Delivered"){
            $deliveredCount++;
        }else if($order_list[$i]["status"] == "Cancelled"){
            $cancelledCount++;
        }

        if($inv_id != ""){
            if($inv_id == $order_list[$i]["inv_id"]){
                $jsonBody = json_encode($order_list[$i]);
                header("Location: orderdetails.php?jsonBody=$jsonBody");
            }
        }
    }

    $orderType="";
    if(isset($_POST['sortby'])){
        $orderType = $_POST['sortby'];
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

            <div class="col-lg-9">
                <!-- Order List Start -->
                <div class="container-fluid pt-5">
                    <!-- <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Order List</span></h2>
                    </div> -->
                    <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Order List</h2>
                            <!-- <div>
                                <a href="#"><button class="btn btn-primary py-2 px-4" type="submit" id="prodAdd"><i class="fa fa-plus"></i> Add Product</button></a>
                            </div> -->
                            <div class="control-group">
                                <form method="POST" action="">
                                    <!-- <select class="form-control" name="sortby" id="sortby" onchange="this.form.submit()">
                                        <option value="" disabled selected>Sort by</option>
                                        <option value="All">All <?php //echo "(".$count.")"; ?></option>
                                        <option value="Processing">Processing <?php //echo "(".$processingCount.")"; ?></option>
                                        <option value="Picked">Picked <?php //echo "(".$pickedCount.")"; ?></option>
                                        <option value="Shipped">Shipped <?php //echo "(".$shippedCount.")"; ?></option>
                                        <option value="Delivered">Delivered <?php //echo "(".$deliveredCount.")"; ?></option>
                                        <option value="Cancelled">Cancelled <?php //echo "(".$cancelledCount.")"; ?></option>
                                    </select> -->

                                    <?php
                                        echo "<select class='form-control' name='sortby' id='sortby' onchange='this.form.submit()' style='border-radius: 25px 25px;'>";
                                            if($orderType == ""){
                                                echo "<option value='' disabled selected>Sort by</option>
                                                    <option value='All'>All ($count)</option>
                                                    <option value='Processing'>Processing ($processingCount)</option>
                                                    <option value='Picked'>Picked ($pickedCount)</option>
                                                    <option value='Shipped'>Shipped ($shippedCount)</option>
                                                    <option value='Delivered'>Delivered ($deliveredCount)</option>
                                                    <option value='Cancelled'>Cancelled ($cancelledCount)</option>";
                                            } else if($orderType == "All"){
                                                echo "<option value='' disabled selected>Sort by</option>
                                                    <option value='All' selected>All ($count)</option>
                                                    <option value='Processing'>Processing ($processingCount)</option>
                                                    <option value='Picked'>Picked ($pickedCount)</option>
                                                    <option value='Shipped'>Shipped ($shippedCount)</option>
                                                    <option value='Delivered'>Delivered ($deliveredCount)</option>
                                                    <option value='Cancelled'>Cancelled ($cancelledCount)</option>";
                                            } else if($orderType == "Processing"){
                                                echo "<option value='' disabled selected>Sort by</option>
                                                    <option value='All'>All ($count)</option>
                                                    <option value='Processing' selected>Processing ($processingCount)</option>
                                                    <option value='Picked'>Picked ($pickedCount)</option>
                                                    <option value='Shipped'>Shipped ($shippedCount)</option>
                                                    <option value='Delivered'>Delivered ($deliveredCount)</option>
                                                    <option value='Cancelled'>Cancelled ($cancelledCount)</option>";
                                            } else if($orderType == "Picked"){
                                                echo "<option value='' disabled selected>Sort by</option>
                                                    <option value='All'>All ($count)</option>
                                                    <option value='Processing'>Processing ($processingCount)</option>
                                                    <option value='Picked' selected>Picked ($pickedCount)</option>
                                                    <option value='Shipped'>Shipped ($shippedCount)</option>
                                                    <option value='Delivered'>Delivered ($deliveredCount)</option>
                                                    <option value='Cancelled'>Cancelled ($cancelledCount)</option>";
                                            } else if($orderType == "Shipped"){
                                                echo "<option value='' disabled selected>Sort by</option>
                                                    <option value='All'>All ($count)</option>
                                                    <option value='Processing'>Processing ($processingCount)</option>
                                                    <option value='Picked'>Picked ($pickedCount)</option>
                                                    <option value='Shipped' selected>Shipped ($shippedCount)</option>
                                                    <option value='Delivered'>Delivered ($deliveredCount)</option>
                                                    <option value='Cancelled'>Cancelled ($cancelledCount)</option>";
                                            } else if($orderType == "Delivered"){
                                                echo "<option value='' disabled selected>Sort by</option>
                                                    <option value='All'>All ($count)</option>
                                                    <option value='Processing'>Processing ($processingCount)</option>
                                                    <option value='Picked'>Picked ($pickedCount)</option>
                                                    <option value='Shipped'>Shipped ($shippedCount)</option>
                                                    <option value='Delivered' selected>Delivered ($deliveredCount)</option>
                                                    <option value='Cancelled'>Cancelled ($cancelledCount)</option>";
                                            } else if($orderType == "Cancelled"){
                                                echo "<option value='' disabled selected>Sort by</option>
                                                    <option value='All'>All ($count)</option>
                                                    <option value='Processing'>Processing ($processingCount)</option>
                                                    <option value='Picked'>Picked ($pickedCount)</option>
                                                    <option value='Shipped'>Shipped ($shippedCount)</option>
                                                    <option value='Delivered'>Delivered ($deliveredCount)</option>
                                                    <option value='Cancelled' selected>Cancelled ($cancelledCount)</option>";
                                            }
                                        echo "</select>";
                                    ?>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid pt-4">
                        <div class="row px-xl-10">
                            <div class="col-lg-12 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-primary text-dark">
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Invoice Id</th>
                                            <th>Full Name</th>
                                            <th>Total Products</th>
                                            <th>Total Price (Tk.)</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th>View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                        <?php 
                                            $sum=0;
                                            for ($i=0; $i < $count; $i++) {
                                                $sum=$sum+1; 
                                                $inv_id = $order_list[$i]["inv_id"];
                                                $full_name = $order_list[$i]["full_name"];
                                                $total_product = $order_list[$i]["total_product"];
                                                $total_payable = $order_list[$i]["total_payable"];
                                                $total_price = sprintf('%.2f', $total_payable);
                                                $delivery_date = $order_list[$i]["delivery_date"];
                                                $status = $order_list[$i]["status"];

                                                $jsonBody = json_encode($order_list[$i]);

                                                // Order List Show //
                                                if($orderType == "" || $orderType == "All"){
                                                    echo "<tr>
                                                        <td class='align-middle'>$sum.</td>
                                                        <td class='align-middle'>#$inv_id</td>
                                                        <td class='align-middle'>$full_name</td>
                                                        <td class='align-middle'>$total_product</td>
                                                        <td class='align-middle'>$total_price</td>
                                                        <td class='align-middle'>$delivery_date</td>
                                                        <td class='align-middle'>$status</td>
                                                        <td class='align-middle'>
                                                            <a href='orderdetails.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-info-circle'></i></button></a>
                                                        </td>
                                                    </tr>";
                                                }else{
                                                    if($orderType == $status){
                                                        echo "<tr>
                                                            <td class='align-middle'>$sum.</td>
                                                            <td class='align-middle'>#$inv_id</td>
                                                            <td class='align-middle'>$full_name</td>
                                                            <td class='align-middle'>$total_product</td>
                                                            <td class='align-middle'>$total_price</td>
                                                            <td class='align-middle'>$delivery_date</td>
                                                            <td class='align-middle'>$status</td>
                                                            <td class='align-middle'>
                                                                <a href='orderdetails.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary'><i class='fa fa-info-circle'></i></button></a>
                                                            </td>
                                                        </tr>";
                                                    }
                                                }
                                                
                                                // if($order_list[$i]["status"] == "Processing"){
                                                //     echo "<tr>
                                                //     <td class='align-middle'>$sum.</td>
                                                //     <td class='align-middle'>#$inv_id</td>
                                                //     <td class='align-middle'>$full_name</td>
                                                //     <td class='align-middle'>$total_product</td>
                                                //     <td class='align-middle'>$total_price</td>
                                                //     <td class='align-middle'>$delivery_date</td>
                                                //     <td class='align-middle'>$status</td>
                                                //     <td class='align-middle'>
                                                //         <a href='orderdetails.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary'><i class='fa fa-info-circle'></i></button></a>
                                                //     </td>
                                                // </tr>";
                                                // }
                                            }  
                                        ?>

                                        <!-- <tr>
                                            <td class="align-middle">#68</td>
                                            <td class="align-middle">Chitra Kormoker</td>
                                            <td class="align-middle">5</td>
                                            <td class="align-middle">Tk. 32100.00</td>
                                            <td class="align-middle">2022-04-23</td>
                                            <td class="align-middle">
                                                <a href="orderdetails.php"><button class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i></button></a>
                                            </td>
                                        </tr> -->                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order List End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

</body>

</html>