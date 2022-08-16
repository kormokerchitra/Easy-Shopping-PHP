
<?php
    $base_url="http://localhost/";
    $user_id = ""; $c_notify = "0"; $total_count = "0";

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }

    if(isset($_POST['yesButtonLogout'])){
        echo "clickd";
        session_start();
        session_unset();
        header("Location: index.php");
    }else{
        
    }

    $url = $base_url."easy_shopping/notification_all_list.php";
    $postdata = http_build_query(
        array(
            'receiver' => 'admin',
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

    $json_data_notify = json_decode($response, true);
        
    $notification_list = $json_data_notify["notification_list"];
    $total_count = count($notification_list);

    for ($i=0; $i < $total_count; $i++) { 
        # code...
        if ($notification_list[$i]["seen"] == "0" &&
          $notification_list[$i]["receiver"] == $user_id){
            $c_notify = count($notification_list);
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("backend-search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });
        
        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
    </script>
    <style>    
        /*.search-box{
            width: 300px;
            position: relative;
            display: inline-block;
            font-size: 14px;
        }*/
        .search-box input[type="text"]{
            height: 40px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 15px;
        }
        .result{
            background-color: white;
            position: absolute;        
            z-index: 999;
            top: 100%;
            left: 0;
        }
        .search-box input[type="text"], .result{
            width: 100%;
            box-sizing: border-box;
        }
        /* Formatting result items */
        .result p{
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }
        .result p:hover{
            background: #f2f2f2;
        }
    </style>

</head>

<body>
    
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="dashboard.php" class="text-decoration-none">                    
                    <h5 class="m-0 display-5 font-weight-semi-bold"><img src="img/logo.jpg" width="30"></img> Easy Shopping Admin</h5>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group search-box">
                        <input type="text" class="form-control" placeholder="Search products here..." style="border-radius: 25px 25px;">
                        <div class="result"></div>
                    </div>
                </form>
            </div>
            
            <!-- <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search products here...">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary border-secondary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div> -->
            <!-- <div class="col-lg-3 col-6 text-right">
                <a href="#" class="nav-item nav-link" id="logout">Logout</a>
            </div> -->

            <div class="col-lg-3 col-6 text-right">
                <div class="btn border-secondary bg-grey" id="notification" style="border-radius: 25px 25px;">
                    <i class="fa fa-bell text-primary"></i>
                    <span class="badge"><?php echo $c_notify; ?></span>
                </div>
                <div class="btn border-secondary bg-grey" id="logout" style="border-radius: 25px 25px;">
                    <i class="fa fa-power-off text-primary"></i>
                </div>

                <!-- <nav>
                    <div class="btn border" id="notification" onclick="toggleNotifi()">
                        <i class="fa fa-bell text-primary"></i>
                        <span class="badge">0</span>
                    </div>
                    <div class="notifi-box" id="box">
                        <h2>Notifications <span>17</span></h2>
                        <div class="notifi-item">
                            <img src="img/logo.jpg" alt="img" width="20"></img>
                            <div class="text">
                               <h4>Elias Abdurrahman</h4>
                               <p>@lorem ipsum dolor sit amet</p>
                            </div> 
                        </div>
                        <div class="notifi-item">
                            <img src="img/logo.jpg" alt="img" width="20"></img>
                            <div class="text">
                               <h4>John Doe</h4>
                               <p>@lorem ipsum dolor sit amet</p>
                            </div> 
                        </div>
                        <div class="notifi-item">
                            <img src="img/logo.jpg" alt="img" width="20"></img>
                            <div class="text">
                               <h4>Emad Ali</h4>
                               <p>@lorem ipsum dolor sit amet</p>
                            </div> 
                        </div>
                    </div>
                </nav> -->
                
                <!-- <div class="notifi-box" id="box">
                    <div class="notifi-item">
                        <div class="text">
                            <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id #568</h6>
                                <br/>
                            </div>
                            <div class="row bg-whiteblue"><h7>Today</h7></div>
                        </div>
                        <div class="text">
                            <h6 class="font-weight-bold mb-2"><img src="img/logo.jpg" width="20"></img>&nbsp;&nbsp;Order status changed to New for invoice id #568</h6>
                                <br/>
                            </div>
                            <div class="row bg-whiteblue"><h7>Today</h7></div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
    <!-- Topbar End -->

    