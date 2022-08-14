<?php

    $vou_id = "";
    $voucherName = "";
    $voucherAmount = "";
    $voucherExpDate = "";
    $voucherExpAmount = "";
    $isSuccess="false";
    $isAddSuccess = "false";
    $isEditSuccess = "false";

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/voucher_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $voucher_list = $json_data["voucher_list"];
    $count = count($voucher_list);

    if(isset($_POST['yesButton'])) {
        $vouId = $_POST['vouid'];

        $url1 = $base_url."easy_shopping/voucher_delete.php";
        $postdata = http_build_query(
            array(
                'vou_id' => $vouId,
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
        // header("Location: couponlist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $voucher_list = $json_data["voucher_list"];
        $count = count($voucher_list);
    }

    if(isset($_POST['addVoucherName'])){
        $voucherName = $_POST['voucherName'];
        $voucherAmount = $_POST['voucherAmount'];
        $voucherExpDate = $_POST['voucherExpDate'];
        $voucherExpAmount = $_POST['voucherExpAmount'];

        $url2 = $base_url."easy_shopping/voucher_add.php";
        $postdata = http_build_query(
            array(
                'vou_name' => $voucherName,
                'vou_amount' => $voucherAmount,
                'vou_exp_date' => $voucherExpDate,
                'vou_exp_amount' => $voucherExpAmount,
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
        // header("Location: couponlist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $voucher_list = $json_data["voucher_list"];
        $count = count($voucher_list);
    }

    if(isset($_POST['editVoucherName'])){
        $voucherNameEdit = $_POST['voucherNameEdit'];
        $voucherAmountEdit = $_POST['voucherAmountEdit'];
        $voucherExpDateEdit = $_POST['voucherExpDateEdit'];
        $voucherExpAmountEdit = $_POST['voucherExpAmountEdit'];
        $voucherStatusEdit = $_POST['voucherStatusEdit'];
        $voucherIDEdit = $_POST['voucherIDEdit'];

        $url3 = $base_url."easy_shopping/voucher_edit.php";
        $postdata = http_build_query(
            array(
                'vou_name' => $voucherNameEdit,
                'vou_amount' => $voucherAmountEdit,
                'vou_exp_date' => $voucherExpDateEdit,
                'vou_exp_amount' => $voucherExpAmountEdit,
                'vou_status' => $voucherStatusEdit,
                'vou_id' => $voucherIDEdit,
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
        $isEditSuccess = "true";
        // header("Location: couponlist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $voucher_list = $json_data["voucher_list"];
        $count = count($voucher_list);
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
                            <a href="couponlist.php" class="nav-item nav-link active"><i class="fa fa-gift"></i> Voucher/Coupon List</a>
                            <a href="reviewlist.php" class="nav-item nav-link"><i class="fas fa-star"></i> Review List</a>
                            <a href="profile.php" class="nav-item nav-link"><i class="fas fa-user-circle"></i> Profile</a>
                        </div>
                    </nav>
                </nav> 
            </div>

            <div class="col-lg-9">
                <!-- Coupon/Voucher Table Start -->
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Coupon/Voucher List</h2>
                            <div>
                                <a href="#"><button class="btn btn-primary py-2 px-4" type="submit" id="voucherAdd" onclick=document.getElementById("myModalAdd").style.display="block" style="border-radius: 25px 25px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Coupon</button></a>
                            </div>
                        </div>
                        <?php
                            if($isSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Coupon/Voucher deleted successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }else if($isAddSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Coupon/Voucher <strong class='mx-4'>".$voucherName."</strong> added successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }else if($isEditSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Coupon/Voucher updated successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }
                        ?>
                    </div>

                    <div class="col-md-12">
                        <div class="col-lg-12">
                            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Active Voucher</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Inactive Voucher</a>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-pane-1">
                                    <div class="col-lg-12 table-responsive mb-5">
                                        <table class="table table-bordered text-center mb-0">
                                            <thead class="bg-primary text-dark">
                                                <tr>
                                                    <th>Serial No.</th>
                                                    <th>Voucher Name</th>
                                                    <th>Voucher Amount (Tk.)</th>
                                                    <th>Expire Date</th>
                                                    <th>Voucher Expected Amount (Tk.)</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">

                                                <?php 
                                                    $sum=0;
                                                    for ($i=0; $i < $count; $i++) {
                                                        $vou_id = $voucher_list[$i]["vou_id"]; 
                                                        $name = $voucher_list[$i]["voucher_name"];
                                                        $voucher_amount = $voucher_list[$i]["voucher_amount"];
                                                        $vou_exp_date = $voucher_list[$i]["vou_exp_date"];
                                                        $voucher_exp_amount = $voucher_list[$i]["voucher_exp_amount"];
                                                        $voucher_status = $voucher_list[$i]["voucher_status"];

                                                        //$modal3Id = "myModal3".$vou_id;

                                                        $today = date("d-m-Y");
                                                        //$expire=$row_voucher["vou_exp_date"];
                                                        $today_time = strtotime($today);
                                                        $expire_time = strtotime($vou_exp_date);
                                                        if($voucher_list[$i]["voucher_status"] == 1 && $expire_time < $today_time){
                                                            $voucher_list[$i]["voucher_status"]=0;
                                                        }

                                                        // Active Voucher/Coupon List Show //
                                                        if($voucher_list[$i]["voucher_status"] == "1"){
                                                            $sum=$sum+1;

                                                            $modal3Id = "myModal3".$vou_id;
                                                            $modalEditId = "myModalEdit".$vou_id;

                                                            echo "<tr>
                                                                <td class='align-middle'>$sum.</td>
                                                                <td class='align-middle'>#$name</td>
                                                                <td class='align-middle'>$voucher_amount</td>
                                                                <td class='align-middle'>$vou_exp_date</td>
                                                                <td class='align-middle'>$voucher_exp_amount</td>
                                                                <td class='align-middle'>
                                                                    <a href='#'><button class='btn btn-sm btn-primary myModal' type='submit' id='voucherEdit' onclick=document.getElementById('$modalEditId').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-edit'></i></button></a>
                                                                </td>
                                                                <td class='align-middle'>
                                                                    <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='voudelete' onclick=document.getElementById('$modal3Id').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-trash'></i></button></a>
                                                                </td>
                                                            </tr>";

                                                            // Coupon/Voucher Delete Modal //
                                                            echo "<div id='$modal3Id' class='modal'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <br/>
                                                                        <div class='text-center mb-0 pt-4'>
                                                                            <h4 class='section-title px-5'><span class='px-2'>Delete Coupon/Voucher</span></h4>
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
                                                                                                <p class='text-center'>Do you want to delete the coupon/voucher $name?</p>
                                                                                                <input type='hidden' class='form-control' placeholder='' name = 'vouid' value='$vou_id' />
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

                                                            // Coupon/Voucher Edit Modal //
                                                            echo "<div id='$modalEditId' class='modal'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <span class='close' onclick=document.getElementById('$modalEditId').style.display='none'>&times;</span>
                                                                        <br/>
                                                                        <div class='text-center mb-0 pt-4'>
                                                                            <h4 class='section-title px-5'><span class='px-2'>Edit Coupon/Voucher</span></h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                                                            <div class='row justify-content-center px-xl-5'>
                                                                                <div class='col-lg-10 mb-5'>
                                                                                    <div class='contact-form'>
                                                                                        <div id='success'></div>
                                                                                        <form name='editVoucher' id='editForm' method='POST'>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucher'><b>Coupon/Voucher Name</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='vouchername' placeholder='Edit voucher name...' required data-validation-required-message='Coupon/voucher name is required' value='$name' name='voucherNameEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucheramount'><b>Coupon/Voucher Amount</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucheramount' placeholder='Edit voucher amount...' required data-validation-required-message='Coupon/voucher amount is required' value='$voucher_amount' name='voucherAmountEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucherexpdate'><b>Coupon/Voucher Expire Date</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucherexpdate' placeholder='Edit voucher expire date...' required data-validation-required-message='Coupon/voucher expire date is required' name' value='$vou_exp_date' name='voucherExpDateEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucherexpamount'><b>Coupon/Voucher Expected Amount</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucherexpamount' placeholder='Edit voucher expected amount...' required data-validation-required-message='Coupon/voucher expected amount is required' value='$voucher_exp_amount' name='voucherExpAmountEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucherstatus'><b>Coupon/Voucher Status</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucherstatus' placeholder='Edit voucher status...' required data-validation-required-message='Coupon/voucher status is required' name' value='$voucher_status' name='voucherStatusEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='row justify-content-center'>
                                                                                                <button class='btn btn-primary py-2 px-4' type='submit' id='editvoucherButton' name = 'editVoucherName' style='border-radius: 25px 25px;'>Edit</button>
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
                                                    <td class="align-middle">##V38322539</td>
                                                    <td class="align-middle">150</td>
                                                    <td class="align-middle">12-09-2022</td>
                                                    <td class="align-middle">
                                                        <a href="#"><button class="btn btn-sm btn-primary" type="submit" id="voucherEdit"><i class="fa fa-edit"></i></button></a>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="#"><button class="btn btn-sm btn-primary" type="submit" id="voudelete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-pane-2">
                                    <div class="col-lg-12 table-responsive mb-5">
                                        <table class="table table-bordered text-center mb-0">
                                            <thead class="bg-primary text-dark">
                                                <tr>
                                                    <th>Serial No.</th>
                                                    <th>Voucher Name</th>
                                                    <th>Voucher Amount (Tk.)</th>
                                                    <th>Expire Date</th>
                                                    <th>Voucher Expected Amount (Tk.)</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-middle">

                                                <?php
                                                    $sum=0; 
                                                    for ($i=0; $i < $count; $i++) {
                                                        $vou_id = $voucher_list[$i]["vou_id"]; 
                                                        $name = $voucher_list[$i]["voucher_name"];
                                                        $voucher_amount = $voucher_list[$i]["voucher_amount"];
                                                        $vou_exp_date = $voucher_list[$i]["vou_exp_date"];
                                                        $voucher_exp_amount = $voucher_list[$i]["voucher_exp_amount"];
                                                        $voucher_status = $voucher_list[$i]["voucher_status"];

                                                        //$modal3Id =  "myModal3".$vou_id;

                                                        // Inactive Voucher/Coupon List Show //
                                                        if($voucher_list[$i]["voucher_status"] == "0"){
                                                            $sum=$sum+1;

                                                            $modal3Id = "myModal3".$vou_id;
                                                            $modalEditId = "myModalEdit".$vou_id;

                                                            echo "<tr>
                                                                <td class='align-middle'>$sum.</td>
                                                                <td class='align-middle'>#$name</td>
                                                                <td class='align-middle'>$voucher_amount</td>
                                                                <td class='align-middle'>$vou_exp_date</td>
                                                                <td class='align-middle'>$voucher_exp_amount</td>
                                                                <td class='align-middle'>
                                                                    <a href='#'><button class='btn btn-sm btn-primary myModal' type='submit' id='voucherEdit' onclick=document.getElementById('$modalEditId').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-edit'></i></button></a>
                                                                </td>
                                                                <td class='align-middle'>
                                                                    <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='voudelete' onclick=document.getElementById('$modal3Id').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-trash'></i></button></a>
                                                                </td>
                                                            </tr>";

                                                            // Coupon/Voucher Delete Modal //
                                                            echo "<div id='$modal3Id' class='modal'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <br/>
                                                                        <div class='text-center mb-0 pt-4'>
                                                                            <h4 class='section-title px-5'><span class='px-2'>Delete Coupon/Voucher</span></h4>
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
                                                                                                <p class='text-center'>Do you want to delete the coupon/voucher $name?</p>
                                                                                                <input type='hidden' class='form-control' placeholder='' name = 'vouid' value='$vou_id' />
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

                                                            // Coupon/Voucher Edit Modal //
                                                            echo "<div id='$modalEditId' class='modal'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <span class='close' onclick=document.getElementById('$modalEditId').style.display='none'>&times;</span>
                                                                        <br/>
                                                                        <div class='text-center mb-0 pt-4'>
                                                                            <h4 class='section-title px-5'><span class='px-2'>Edit Coupon/Voucher</span></h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                                                            <div class='row justify-content-center px-xl-5'>
                                                                                <div class='col-lg-10 mb-5'>
                                                                                    <div class='contact-form'>
                                                                                        <div id='success'></div>
                                                                                        <form name='editVoucher' id='editForm' method='POST'>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucher'><b>Coupon/Voucher Name</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='vouchername' placeholder='Edit voucher name...' required data-validation-required-message='Coupon/voucher name is required' value='$name' name='voucherNameEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucheramount'><b>Coupon/Voucher Amount</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucheramount' placeholder='Edit voucher amount...' required data-validation-required-message='Coupon/voucher amount is required' value='$voucher_amount' name='voucherAmountEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucherexpdate'><b>Coupon/Voucher Expire Date</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucherexpdate' placeholder='Edit voucher expire date...' required data-validation-required-message='Coupon/voucher expire date is required' name' value='$vou_exp_date' name='voucherExpDateEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucherexpamount'><b>Coupon/Voucher Expected Amount</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucherexpamount' placeholder='Edit voucher expected amount...' required data-validation-required-message='Coupon/voucher expected amount is required' value='$voucher_exp_amount' name='voucherExpAmountEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='control-group'>
                                                                                                <label for='editvoucherstatus'><b>Coupon/Voucher Status</b></label>
                                                                                                <span class='text-danger'>*</span>
                                                                                                <input type='text' class='form-control' id='voucherstatus' placeholder='Edit voucher status...' required data-validation-required-message='Coupon/voucher status is required' name' value='$voucher_status' name='voucherStatusEdit' style='border-radius: 25px 25px;' />
                                                                                                <input type='hidden' value='$vou_id' name='voucherIDEdit' style='border-radius: 25px 25px;'/>
                                                                                                <p class='help-block text-danger'></p>
                                                                                            </div>
                                                                                            <div class='row justify-content-center'>
                                                                                                <button class='btn btn-primary py-2 px-4' type='submit' id='editvoucherButton' name = 'editVoucherName' style='border-radius: 25px 25px;'>Edit</button>
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
                                                    <td class="align-middle">##V38322539</td>
                                                    <td class="align-middle">150</td>
                                                    <td class="align-middle">12-09-2022</td>
                                                    <td class="align-middle">
                                                        <a href="#"><button class="btn btn-sm btn-primary" type="submit" id="voucherEdit"><i class="fa fa-edit"></i></button></a>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="#"><button class="btn btn-sm btn-primary" type="submit" id="voudelete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Coupon/Voucher Table End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

    <!-- Coupon/Voucher Add Modal -->
    <div id="myModalAdd" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span onclick=document.getElementById("myModalAdd").style.display="none" class="close">&times;</span>
                <br/>
                <div class="text-center mb-0 pt-4">
                    <h4 class="section-title px-5"><span class="px-2">Add Coupon/Voucher</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 py-0 bg-whiteblue">
                    <div class="row justify-content-center px-xl-5">
                        <div class="col-lg-10 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="voucherAdd" id="voucherForm" method="POST" action="">
                                    <div class="control-group">
                                        <label for="vouchername"><b>Coupon/Voucher Name</b></label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="vouchername" name="voucherName" placeholder="Enter voucher name..." required data-validation-required-message="Coupon/voucher name is required" style="border-radius: 25px 25px;" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="voucheramount"><b>Coupon/Voucher Amount</b></label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="voucheramount" name="voucherAmount" placeholder="Enter voucher amount..." required data-validation-required-message="Coupon/voucher amount is required" style="border-radius: 25px 25px;" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="voucherexpdate"><b>Coupon/Voucher Expire Date</b></label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="voucherexpdate" name="voucherExpDate" placeholder="Enter voucher expire date..." required data-validation-required-message="Coupon/voucher expire date is required" style="border-radius: 25px 25px;" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="voucheramount"><b>Coupon/Voucher Expected Amount</b></label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="voucherexpamount" name="voucherExpAmount" placeholder="Enter voucher expected amount..." required data-validation-required-message="Coupon/voucher expected amount is required" style="border-radius: 25px 25px;" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="row justify-content-center">
                                        <button class="btn btn-primary py-2 px-4" type="submit" name="addVoucherName" id="addvoucherButton" style="border-radius: 25px 25px;">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>

    <!-- Coupon/Voucher Edit Modal -->
    <!-- <div id="myModal2" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <br/>
                <div class="text-center mb-4 pt-4">
                    <h4 class="section-title px-5"><span class="px-2">Edit Coupon/Voucher</span></h4>
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
                                        <label for="vouchername"><b>Coupon/Voucher Name</b></label>
                                        <input type="text" class="form-control" id="vouchername" placeholder="Edit voucher name..." required="required" data-validation-required-message="Please edit voucher name" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="voucheramount"><b>Coupon/Voucher Amount</b></label>
                                        <input type="text" class="form-control" id="voucheramount" placeholder="Edit voucher amount..." required="required" data-validation-required-message="Please edit voucher amount" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="voucherexpdate"><b>Coupon/Voucher Expire Date</b></label>
                                        <input type="text" class="form-control" id="voucherexpdate" placeholder="Edit voucher expire date..." required="required" data-validation-required-message="Please edit voucher expire date" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="voucherstatus"><b>Coupon/Voucher Status</b></label>
                                        <input type="text" class="form-control" id="voucherstatus" placeholder="Edit voucher status..." required="required" data-validation-required-message="Please edit voucher status" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary py-2 px-4" type="submit" id="editvoucherButton">Edit</button>
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
    //var modal1 = document.getElementById("myModalAdd");
    //var modal2 = document.getElementById("myModal2");

    // Get the button that opens the modal
    //var btn1 = document.getElementById("voucherAdd");
    //var btn2 = document.getElementById("voucherEdit");

    // Get the <span> element that closes the modal
    //var span1 = document.getElementsByClassName("close")[1];
    //var span2 = document.getElementsByClassName("close")[2];

    // When the user clicks the button, open the modal
    // btn1.onclick = function() {
    //   modal1.style.display = "block";
    // }
    // btn2.onclick = function() {
    //   modal2.style.display = "block";
    // }

    // When the user clicks on <span> (x), close the modal
    // span1.onclick = function() {
    //   modal1.style.display = "none";
    // }
    // span2.onclick = function() {
    //   modal2.style.display = "none";
    // }

    // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal1) {
    //     modal1.style.display = "none";
    //   }
    // }
    // window.onclick = function(event) {
    //   if (event.target == modal2) {
    //     modal2.style.display = "none";
    //   }
    // }
    </script>
</body>

</html>

