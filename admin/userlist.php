<?php  
    $id = "";
    $isSuccess="false";

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/user_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $user_list = $json_data["user_list"];
    $count = count($user_list);

    if(isset($_POST['yesButton'])) {
        $userId = $_POST['userid'];;
        $url1 = $base_url."easy_shopping/user_delete.php";
        $postdata = http_build_query(
            array(
                'user_id' => $userId,
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

        $response = file_get_contents($url1, false, $context);
        $isSuccess = "true";
        // header("Location: userlist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $user_list = $json_data["user_list"];
        $count = count($user_list);
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
                            <a href="userlist.php" class="nav-item nav-link active"><i class="fas fa-user-alt"></i> User List</a>
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
                <!-- User List Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">User List</span></h2>

                        <?php
                            if($isSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> User deleted successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }
                        ?>
                        
                    </div>
                    <!-- <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">User List</h2>
                        </div>
                    </div> -->
                    <div class="container-fluid py-4">
                        <div class="row px-xl-10">
                            <div class="col-lg-12 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-primary text-dark">
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Phone No.</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        <!-- <tr>
                                            <td class="align-middle"><img src="img/hp1.jpeg" alt="" style="width: 50px;"> HP Chromebook 14</td>
                                            <td class="align-middle">4.5</td>
                                            <td class="align-middle">Tk. 32100.00</td>
                                            <td class="align-middle">
                                                <a href="detail.html"><button class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i></button></a>
                                            </td>
                                            <td class="align-middle">
                                                <a href=""><button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button></a>
                                            </td>
                                            <td class="align-middle">
                                                <a href=""><button class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                        </tr> -->

                                        <?php 
                                            $sum=0;
                                            for ($i=0; $i < $count; $i++) { 
                                                $img =$base_url.$user_list[$i]["pro_pic"];
                                                $name = $user_list[$i]["full_name"];
                                                $address = $user_list[$i]["address"];
                                                $email = $user_list[$i]["email"];
                                                $phone_num = $user_list[$i]["phone_num"];
                                                $id = $user_list[$i]['user_id'];

                                                if($user_list[$i]["pro_pic"]==""){
                                                    $img = 'img/user.png';
                                                }

                                                if($user_list[$i]["user_id"] != "4"){
                                                    $sum=$sum+1;

                                                    $modal1Id = "myModal".$id;
                                                    
                                                    // User List Show //
                                                    echo "<tr>
                                                        <td class='align-middle'>$sum.</td>
                                                        <td class='align-middle'><img src=$img alt='' style='width: 50px; height: 50px; border-radius: 25px 25px;'><br/>$name</td>
                                                        <td class='align-middle'>$address</td>
                                                        <td class='align-middle'>$email</td>
                                                        <td class='align-middle'>$phone_num</td>
                                                        <td class='align-middle'>
                                                            <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='deleteuser' onclick=document.getElementById('$modal1Id').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-trash'></i></button></a>
                                                        </td>
                                                    </tr>";

                                                    // User Delete Modal //
                                                    echo "<div id='$modal1Id' class='modal'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <br/>
                                                                <div class='text-center mb-0 pt-4'>
                                                                    <h4 class='section-title px-5'><span class='px-2'>Delete User</span></h4>
                                                                </div>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                                                    <div class='row justify-content-center px-xl-5'>
                                                                        <div class='col-lg-12 mb-5'>
                                                                            <div class='contact-form'>
                                                                                <div id='success'></div>
                                                                                <form name='sentMessage' id='contactForm' method='POST'>
                                                                                    <div class='control-group'>
                                                                                        <p class='text-center'>Do you want to delete $name?</p>
                                                                                        <input type='hidden' class='form-control' placeholder='' name = 'userid' value='$id' />
                                                                                        <div class='row justify-content-center'>
                                                                                        <button class='btn btn-primary py-2 px-4 bg-red' type='submit' id='noButton' name='noButton' style='border-radius: 25px 25px;'>No</button>&nbsp;&nbsp;&nbsp;
                                                                                        <button class='btn btn-primary py-2 px-4 bg-green' type='submit' id='yesButton' name='yesButton' style='border-radius: 25px 25px;'>Yes</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                            </div>
                                                        </div>
                                                    </div>";

                                                    // echo "<script>
    
                                                    //     var modal1 = document.getElementById('$modal1Id');

                                                        
                                                    //     var btn1 = document.getElementById('deleteuser');

                                                        
                                                    //     var span1 = document.getElementsByClassName('close')[1];

                                                        
                                                    //     btn1.onclick = function() {
                                                    //       modal1.style.display = 'block';
                                                    //     }

                                                        
                                                    //     span1.onclick = function() {
                                                    //       modal1.style.display = 'none';
                                                    //     }

                                                        
                                                    //     window.onclick = function(event) {
                                                    //       if (event.target == modal1) {
                                                    //         modal1.style.display = 'none';
                                                    //       }
                                                    //     }
                                                    // </script>";
                                                }
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
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

</body>

</html>