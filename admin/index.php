<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        header("Location: dashboard.php");
    }
    $base_url="http://localhost/";
    if(isset($_POST['loginBtn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $url = $base_url."easy_shopping/login.php";
        $postdata = http_build_query(
            array(
                'email' => $email,
                'password' => $password,
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

        if($response != "failure"){
            $json_data = json_decode($response, true);
            
            $user_info = $json_data["user_info"];
            $_SESSION['user_id'] = $user_info["user_id"];
            if($user_info["user_id"] == "4"){
               header("Location: dashboard.php"); 
           }else{
               echo "You are not an authorised user";
           }
            
        }else{
            echo "Cannot login user";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Easy Shopping Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-4 d-none d-lg-block">
                <a href="" class="text-decoration-none">                
                    <h4 class="m-0 display-5 font-weight-semi-bold"><img src="img/logo.jpg" width="40"></img> Easy Shopping Admin</h4>
                </a>
            </div>
            <!-- <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div> -->
            <!-- <div class="col-lg-3 col-6 text-right">
                <a href="dashboard.php" class="nav-item nav-link">Next</a>
                <a href="dashboard.html"><button class="btn btn-primary py-2 px-4" type="submit" id="extraButton">Next</button></a>
            </div> -->
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row justify-content-center border-top px-xl-5">
            <div class="col-lg-6">
                <!-- Login/Sign In Start -->
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">Login/Sign In</span></h2>
                    </div><Br/>
                    <div class="container-fluid py-4 bg-whiteblue" style="border-radius: 25px 25px 25px 25px;">
                        <div class="row px-xl-5 py-4">
                            <div class="col-lg-12 mb-5">
                                <div class="contact-form">
                                    <div id="success"></div>
                                    <form name="login" id="loginForm" method="POST" action="">
                                        <div class="control-group">
                                            <label for="email"><b>Email</b></label>
                                            <input type="text" class="form-control" id="email" name="email"  placeholder="Enter your email..." required data-validation-required-message="Email is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="password"><b>Password</b></label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password..." required data-validation-required-message="Password is required" style="border-radius: 25px 25px;" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button class="btn btn-primary py-2 px-4" type="submit" id="loginButton" name="loginBtn" style="border-radius: 25px 25px;">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Login/Sign In End -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php
        include "footer.php";
    ?>

</body>

</html>


