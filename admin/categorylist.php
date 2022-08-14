<?php  

    $cat_id = "";
    $catgoryName = "";
    $isSuccess="false";
    $isAddSuccess="false";
    $isEditSuccess="false";

    $base_url="http://localhost/";
    $url = $base_url."easy_shopping/category_list.php";
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    $cat_list = $json_data["cat_list"];
    $count = count($cat_list);

    if(isset($_POST['yesButton'])) {
        $catId = $_POST['catid'];
        
        $url1 = $base_url."easy_shopping/category_delete.php";
        $postdata = http_build_query(
            array(
                'cat_id' => $catId,
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
        // header("Location: categorylist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $cat_list = $json_data["cat_list"];
        $count = count($cat_list);
    }

    if(isset($_POST['addCategoryName'])){
        $catgoryName = $_POST['catgoryName'];
        
        $url2 = $base_url."easy_shopping/category_add.php";
        $postdata = http_build_query(
            array(
                'cat_name' => $catgoryName,
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
        // header("Location: categorylist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $cat_list = $json_data["cat_list"];
        $count = count($cat_list);
    }

    if(isset($_POST['editCategoryName'])){
        $categoryNameEdit = $_POST['categoryNameEdit'];
        $categoryIDEdit = $_POST['categoryIDEdit'];
         
        $url3 = $base_url."easy_shopping/category_edit.php";
        $postdata = http_build_query(
            array(
                'cat_name' => $categoryNameEdit,
                'cat_id' => $categoryIDEdit,
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
        // header("Location: categorylist.php");
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $cat_list = $json_data["cat_list"];
        $count = count($cat_list);
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
                            <a href="categorylist.php" class="nav-item nav-link active"><i class="fas fa-shapes"></i> Category List</a>      
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
                <!-- Category List Start -->
                <div class="container-fluid pt-5">
                    <div class="row px-xl-5">
                        <div class="btn shadow-none d-flex align-items-center justify-content-between text-white w-100">
                            <h2 class="font-weight-bold text-dark mb-4">Category List</h2>
                            <div>
                                <a href="#"><button class="btn btn-primary py-2 px-4" type="submit" id="addcat" onclick=document.getElementById("myModalAdd").style.display="block" style="border-radius: 25px 25px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Category</button></a>
                            </div>
                        </div>

                        <?php
                            if($isSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Category deleted successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }else if($isAddSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Category <strong class='mx-4'>".$catgoryName."</strong> added successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }else if($isEditSuccess == "true"){
                                echo "<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'>
                                    <i class='bi-check-circle-fill'></i>
                                    <strong class='mx-4'>Success!</strong> Category updated successfully.
                                    <button type='button' class='close' data-dismiss='alert' aria-label=
                                    'Close'><span aria-hidden='true'>&times;</span></button>
                                </div>";    
                            }
                        ?>

                    </div>
                    <div class="container-fluid pt-4">
                        <div class="row px-xl-10">
                            <div class="col-lg-12 table-responsive mb-5">
                                <table class="table table-bordered text-center mb-0">
                                    <thead class="bg-primary text-dark">
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Category Name</th>
                                            <th>Total Products</th>
                                            <th>View Details</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">

                                        <?php 
                                            $sum=0;
                                            for ($i=0; $i < $count; $i++) { 
                                                $sum=$sum+1;
                                                $cat_id = $cat_list[$i]["cat_id"];
                                                $name = $cat_list[$i]["cat_name"];
                                                $product_count = $cat_list[$i]["product_count"];

                                                $modalDeleteId = "myModalDelete".$cat_id;
                                                $modalEditId = "myModalEdit".$cat_id;

                                                // Category List Show //
                                                echo "<tr>
                                                    <td class='align-middle'>$sum.</td>
                                                    <td class='align-middle'>$name</td>
                                                    <td class='align-middle'>$product_count</td>
                                                    <td class='align-middle'>
                                                        <a href='products.php?cat_id=$cat_id&cat_name=$name'><button class='btn btn-sm btn-primary' style='border-radius: 25px 25px;'><i class='fa fa-info-circle'></i></button></a>
                                                    </td>
                                                    <td class='align-middle'>
                                                        <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='editcat' onclick=document.getElementById('$modalEditId').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-edit'></i></button></a>
                                                    </td>
                                                    <td class='align-middle'>
                                                        <a href='#'><button class='btn btn-sm btn-primary' type='submit' id='deletecat' onclick=document.getElementById('$modalDeleteId').style.display='block' style='border-radius: 25px 25px;'><i class='fa fa-trash'></i></button></a>
                                                    </td>
                                                </tr>";

                                                // Category Delete Modal //
                                                echo "<div id='$modalDeleteId' class='modal'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <br/>
                                                            <div class='text-center mb-0 pt-4'>
                                                                <h4 class='section-title px-5'><span class='px-2'>Delete Category</span></h4>
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
                                                                                    <p class='text-center'>Do you want to delete the category $name?</p>
                                                                                    <input type='hidden' class='form-control' placeholder='' name = 'catid' value='$cat_id' />
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

                                                // Category Edit Modal //
                                                echo "<div id='$modalEditId' class='modal'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <span class='close' onclick=document.getElementById('$modalEditId').style.display='none'>&times;</span>
                                                            <br/>
                                                            <div class='text-center mb-0 pt-4'>
                                                                <h4 class='section-title px-5'><span class='px-2'>Edit Category</span></h4>
                                                            </div>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <div class='container-fluid pt-4 py-0 bg-whiteblue'>
                                                                <div class='row justify-content-center py-0 px-xl-5'>
                                                                    <div class='col-lg-10 mb-5'>
                                                                        <div class='contact-form'>
                                                                            <div id='success'></div>
                                                                            <form name='editCategory' id='editForm' method='POST'>
                                                                                <div class='control-group'>
                                                                                    <label for='editcategory'><b>Category Name</b></label>
                                                                                    <span class='text-danger'>*</span>
                                                                                    <input type='text' class='form-control' id='editcategory' placeholder='Edit category name...' required='required' data-validation-required-message='Category name is required' value='$name' name='categoryNameEdit' style='border-radius: 25px 25px;'/>
                                                                                    <input type='hidden' value='$cat_id'  name='categoryIDEdit' style='border-radius: 25px 25px;'/>
                                                                                    <p class='help-block text-danger'></p>
                                                                                </div>
                                                                                <div class='row justify-content-center'>
                                                                                    <button class='btn btn-primary py-2 px-4' type='submit' id='editcatButton' name = 'editCategoryName' style='border-radius: 25px 25px;'>Edit</button>
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
    
                                                //     var modal3 = document.getElementById('$modal2Id');
                                                        
                                                //     var btn1 = document.getElementById('editcat');
                                                        
                                                //     var span1 = document.getElementsByClassName('close')[2];
                                                       
                                                //     btn1.onclick = function() {
                                                //       modal3.style.display = 'block';
                                                //     }
                                                       
                                                //     span1.onclick = function() {
                                                //       modal3.style.display = 'none';
                                                //     }
                                                        
                                                //     window.onclick = function(event) {
                                                //       if (event.target == modal3) {
                                                //         modal3.style.display = 'none';
                                                //       }
                                                //     }
                                                // </script>";
                                            }  
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Category List End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

    <!-- Category Add Modal -->
    <div id="myModalAdd" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span onclick=document.getElementById("myModalAdd").style.display="none" class="close">&times;</span>
                <br/>
                <div class="text-center pt-4 mb-0">
                    <h4 class="section-title px-5"><span class="px-2">Add Category</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 py-0 bg-whiteblue">
                    <div class="row justify-content-center py-0 px-xl-5">
                        <div class="col-lg-10 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="categoryAdd" id="categoryForm" method="POST" action="">
                                    <div class="control-group">
                                        <label for="addcategory"><b>Category Name</b></label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="addcategory" name="catgoryName" placeholder="Enter category name..." required data-validation-required-message="Category name is required" style="border-radius: 25px 25px;" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="row justify-content-center">
                                        <button class="btn btn-primary py-2 px-4" type="submit" name="addCategoryName" id="addcatButton" style="border-radius: 25px 25px;">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>

    <!-- Category Edit Modal -->
    <!-- <div id="myModal2" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <br/>
                <div class="text-center mb-4 pt-4">
                    <h4 class="section-title px-5"><span class="px-2">Edit Category</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 py-0 bg-whiteblue">
                    <div class="row justify-content-center py-0 px-xl-5">
                        <div class="col-lg-10 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                                    <div class="control-group">
                                        <label for="editcategory"><b>Category Name</b></label>
                                        <input type="text" class="form-control" id="editcategory" placeholder="Edit category name..." required="required" data-validation-required-message="Please edit category name" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary py-2 px-4" type="submit" id="editcatButton">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>  -->

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
    <!-- <script>

    // Get the modal
    var modal1 = document.getElementById("myModalAdd");
    // var modal2 = document.getElementById("myModal2");
    //var modal3 = document.getElementById("myModal3");

    // Get the button that opens the modal
    var btn1 = document.getElementById("addcat");
    // var btn2 = document.getElementById("editcat");
    //var btn3 = document.getElementById("deletecat");

    // Get the <span> element that closes the modal
    var span1 = document.getElementsByClassName("close")[1];
    // var span2 = document.getElementsByClassName("close")[2];
    //var span3 = document.getElementsByClassName("close")[3];

    // When the user clicks the button, open the modal 
    btn1.onclick = function() {
      modal1.style.display = "block";
    }
    // btn2.onclick = function() {
    //   modal2.style.display = "block";
    // }
    // btn3.onclick = function() {
    //   modal3.style.display = "block";
    // }

    // When the user clicks on <span> (x), close the modal
    span1.onclick = function() {
      modal1.style.display = "none";
    }
    // span2.onclick = function() {
    //   modal2.style.display = "none";
    // }
    // span3.onclick = function() {
    //   modal3.style.display = "none";
    // }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal1) {
        modal1.style.display = "none";
      }
    }
    // window.onclick = function(event) {
    //   if (event.target == modal2) {
    //     modal2.style.display = "none";
    //   }
    // }
    // window.onclick = function(event) {
    //   if (event.target == modal3) {
    //     modal3.style.display = "none";
    //   }
    // }

    // Get the modal
    //var modal = document.getElementsByClassName("modal");

    // Get the button that opens the modal
    //var btn = document.getElementsByClassName("myModal");
    //for (var i = 0; i < btn.length; i++) {
        //var thisBtn = btn[i];
        //thisBtn.addEventListener("click", function(){
            //var modal = document.getElementById(this.dataset.modal);
            //modal.style.display = "block";
    //}, false); }

    // Get the <span> element that closes the modal
    //var span = document.getElementsByClassName("close");

    // When the user clicks the button, open the modal 
    //btn[0].onclick = function() {
      //modal[0].style.display = "block";
    //}
    //btn[1].onclick = function() {
      //modal[1].style.display = "block";
    //}

    // When the user clicks on <span> (x), close the modal
    //span[0].onclick = function() {
      //modal[0].style.display = "none";
    //}
    //span[1].onclick = function() {
      //modal[1].style.display = "none";
    //}

    // When the user clicks anywhere outside of the modal, close it
    //window.onclick = function(event) {
      //if (event.target == modal[0]) {
        //modal[0].style.display = "none";
      //}
    //}
    //window.onclick = function(event) {
      //if (event.target == modal[1]) {
        //modal[1].style.display = "none";
      //}
    //}
    
    </script> -->
</body>

</html>