<?php

    $prod_id = ""; 
    $isEditSuccess="false"; 

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/product_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $product_list = $json_data["product_list"];
    $count = count($product_list);

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
        $isEditSuccess = "true";
        // header("Location: categorylist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $product_list = $json_data["product_list"];
        $count = count($product_list);
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
                            <a href="discountlist.php" class="nav-item nav-link active"><i class="fa fa-list-alt"></i> Discount List</a>
                            <a href="orderlist.php" class="nav-item nav-link"><i class="fas fa-cart-plus"></i> Order List</a>
                            <a href="couponlist.php" class="nav-item nav-link"><i class="fa fa-gift"></i> Voucher/Coupon List</a>
                            <a href="reviewlist.php" class="nav-item nav-link"><i class="fas fa-star"></i> Review List</a>
                            <a href="profile.php" class="nav-item nav-link"><i class="fas fa-user-circle"></i> Profile</a>
                        </div>
                    </nav>
                </nav>
            </div>
            <div class="col-lg-9">
                <!-- Discount Products Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Discount List</span></h2>

                        <?php
                            if($isEditSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Discount updated successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }
                        ?>

                    </div>
                    <!-- <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Discount List</h2>
                            <div>
                                <a href=""><button class="btn btn-primary py-2 px-4" type="submit" id="prodAdd"><i class="fa fa-plus"></i> Add Product</button></a>
                            </div>
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
                                            <th>Stock</th>
                                            <th>Product Price (Tk.)</th>
                                            <th>Discount (%)</th>
                                            <th>Discount Price (Tk.)</th>
                                            <th>View Details</th>                                       
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                        <?php
                                            $sum=0; 
                                            for ($i=0; $i < $count; $i++) { 
                                                $img =$base_url.$product_list[$i]["product_img"];
                                                $prod_id = $product_list[$i]["prod_id"];
                                                $name = $product_list[$i]["product_name"];
                                                $stock = $product_list[$i]["prod_quantity"];
                                                $product_price = $product_list[$i]["product_price"];
                                                $prod_discount = $product_list[$i]["prod_discount"];

                                                if($product_list[$i]["product_img"]==""){
                                                    $img = 'img/product_back.jpg';
                                                }

                                                $jsonBody = json_encode($product_list[$i]);

                                                if($product_list[$i]["prod_discount"] != "0"){                   
                                                    $discount_price = $product_price - ($product_price * ($prod_discount / 100));
                                                    $disc_price = sprintf('%.2f', $discount_price);
                                                    $sum=$sum+1;

                                                    $modalEditId = "myModalEdit".$prod_id;

                                                    // Discount Product List Show //
                                                    echo "<tr>
                                                        <td class='align-middle'>$sum.</td>
                                                        <td class='align-middle'><img src=$img alt='' style='width: 50px;'><br/>$name</td>
                                                        <td class='align-middle'>$stock</td>
                                                        <td class='align-middle'>$product_price</td>
                                                        <td class='align-middle'>$prod_discount</td>
                                                        <td class='align-middle'>$disc_price</td>
                                                        <td class='align-middle'>
                                                        <a href='detail.php?jsonBody=$jsonBody'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-info-circle'></i></button></a>
                                                        </td>
                                                        <td class='align-middle'>
                                                        <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='editdiscount' onclick=document.getElementById('$modalEditId').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-edit'></i></button></a>
                                                        </td>
                                                    </tr>";

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
                                                                                <form name='editDiscount' id='editForm' method='POST'>
                                                                                    <div class='control-group'>
                                                                                        <label for='editdisc'><b>Discount (%)</b></label>
                                                                                        <span class='text-danger'>*</span>
                                                                                        <input type='text' class='form-control' id='editdisc' placeholder='Enter discount...' required data-validation-required-message='Discount (%) is required' value='$prod_discount' name='discountNameEdit' style='border-radius: 25px 25px;' />
                                                                                        <input type='hidden' value='$prod_id'  name='discountIDEdit' style='border-radius: 25px 25px;'/>
                                                                                        <p class='help-block text-danger'></p>
                                                                                    </div>
                                                                                    <div class='row justify-content-center'>
                                                                                        <button class='btn btn-primary py-2 px-4' type='submit' id='editdiscButton' name = 'editDiscountName' style='border-radius: 25px 25px;'>Edit</button>
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
                                            }   
                                        ?>

                                        <!-- <tr>
                                            <td class="align-middle"><img src="img/hp1.jpeg" alt="" style="width: 50px;"><br/>HP Chromebook 14</td>
                                            <td class="align-middle">15</td>
                                            <td class="align-middle">Tk. 32100.00</td>
                                            <td class="align-middle">30</td>
                                            <td class="align-middle">Tk. 25000.00</td>
                                            <td class="align-middle">
                                                <a href="detail.php"><button class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i></button></a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="#"><button class="btn btn-sm btn-primary myModal" type="submit" id="editdiscount"><i class="fa fa-edit"></i></button></a>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Discount Products End -->
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

    <!-- Discount Edit Modal -->
    <!-- <div id="myModal1" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <br/>
                <div class="text-center mb-4 pt-4">
                    <h4 class="section-title px-5"><span class="px-2">Edit Product Discount</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 py-0 bg-whiteblue">
                    <div class="row justify-content-center px-xl-5">
                        <div class="col-lg-10 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                                    <div class="control-group">
                                        <label for="editdisc"><b>Discount (%)</b></label>
                                        <input type="text" class="form-control" id="editdisc" placeholder="Enter discount..." required="required" data-validation-required-message="Please enter discount" />
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
    //var modal1 = document.getElementById("myModal1");

    // Get the button that opens the modal
    //var btn1 = document.getElementById("editdiscount");

    // Get the <span> element that closes the modal
    //var span1 = document.getElementsByClassName("close")[1];

    // When the user clicks the button, open the modal
    // btn1.onclick = function() {
    //   modal1.style.display = "block";
    // }

    // When the user clicks on <span> (x), close the modal
    // span1.onclick = function() {
    //   modal1.style.display = "none";
    // }

    // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal1) {
    //     modal1.style.display = "none";
    //   }
    // }
    </script>
</body>

</html>