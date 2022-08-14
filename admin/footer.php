	
	<!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">easyshopping.com</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="#">Chitra Codex</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top" style="border-radius: 25px 25px;"><i class="fa fa-angle-double-up"></i></a>

    <!-- Notification Modal -->
    <div id="notificationModal" class="modal">
        <div class="modal-content" style="overflow-y: scroll; max-height:85%; margin-top: 50px; margin-bottom:50px;" >
            <div class="modal-header">
                <span class="close">&times;</span>
                <br/>
                <div class="text-center mb-0 pt-4">
                    <h4 class="section-title px-5"><span class="px-2">Notification</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <!-- <div class="container-fluid pt-4 py-0 bg-grey1"> -->
                <div class="container-fluid pt-4 py-0">
                    <div class="row justify-content-center px-xl-5">
                        <div class="col-lg-12 mb-5 px-xl-4">
                            
                            <div class="row">
                                <br/>
                                <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id <a href="#">#568</a></h6>
                                <br/>
                            </div>
                            <div class="row"><h7>Today</h7></div>
                            <hr>
                            <div class="row">
                                <br/>
                                <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id <a href="#">#568</a></h6>
                                <br/>
                            </div>
                            <div class="row"><h7>Today</h7></div>
                            <hr>
                            <div class="row">
                                <br/>
                                <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id <a href="#">#568</a></h6>
                                <br/>
                            </div>
                            <div class="row"><h7>Today</h7></div>
                            <hr>
                            <div class="row">
                                <br/>
                                <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id <a href="#">#568</a></h6>
                                <br/>
                            </div>
                            <div class="row"><h7>Today</h7></div>
                            <hr>

                            <!-- <div class="align-middle">
                                <div class="nav-profile-text d-flex flex-column bg-whiteblue">
                                    <br/>
                                    <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id #568</h6>
                                    <h7>Today</h7><br/>
                                </div>
                            </div>
                            <hr>
                            <div class="align-middle">
                                <div class="nav-profile-text d-flex flex-column bg-whiteblue">
                                    <br/>
                                    <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id #568</h6>
                                    <h7>Today</h7><br/>
                                </div>
                            </div>
                            <hr> -->

<!-- www.youtube.com/watch?v=1EN8_OxvPuY -->

                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <span class="close">&times;</span>
                <br/> -->
                <div class="text-center mb-0 pt-4">
                    <h4 class="section-title px-5"><span class="px-2">Logout</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid pt-4 py-0 bg-whiteblue">
                    <div class="row justify-content-center px-xl-5">
                        <div class="col-lg-12 mb-5">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="sentMessage" id="contactForm" method="POST" action="">
                                    <div class="control-group">
                                        <p class="text-center">Do you want to logout?</p>
                                        <div class="row justify-content-center">
                                            <button class="btn btn-primary py-2 px-4 bg-red" type="submit" id="noButton" style="border-radius: 25px 25px;">No</button>&nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-primary py-2 px-4 bg-green" type="submit" id="yesButton" style="border-radius: 25px 25px;">Yes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
            <!-- <div class="modal-footer">
              <h3>Modal Footer</h3>
            </div> -->
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

    // var notifyModal = document.getElementById("box");
    // var down = false;

    // function toggleNotifi(){
    //     if(down) {
    //         box.style.height = '0px';
    //         box.style.opacity = 0;
    //         down = false;
    //     }
    //     else {
    //         box.style.height = '510px';
    //         box.style.opacity = 1;
    //         down = true;
    //     }
    // }

    // Get the modal
    var notifyModal = document.getElementById("notificationModal");
    var logOutModal = document.getElementById("logoutModal");

    // Get the button that opens the modal
    var notifybtn = document.getElementById("notification");
    var logoutbtn = document.getElementById("logout");

    // Get the <span> element that closes the modal
    var notifyspan = document.getElementsByClassName("close")[0];
    var logoutspan = document.getElementsByClassName("close")[1];

    // When the user clicks the button, open the modal 
    notifybtn.onclick = function() {
      notifyModal.style.display = "block";
    }
    logoutbtn.onclick = function() {
      logOutModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    notifyspan.onclick = function() {
      notifyModal.style.display = "none";
    }
    logoutspan.onclick = function() {
      logOutModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == notifyModal) {
        notifyModal.style.display = "none";
      }
    }
    window.onclick = function(event) {
      if (event.target == logOutModal) {
        logOutModal.style.display = "none";
      }
    }
    </script>