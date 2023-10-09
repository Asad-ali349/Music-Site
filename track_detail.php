<?php
include_once('admin/db/conn.php');
$id=$_GET['id'];
$track=mysqli_fetch_assoc(mysqli_query($conn,"Select * from tracks where id='$id'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>One Music</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu bg-dark" style="margin-top:-20px">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="oneMusicNav">
                        <!-- Nav brand -->
                        <a href="index.html" class="nav-brand"><img src="img/core-img/logo.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                    <li><a href="login.php">Login / register</a></li>
                                </ul>
                                <!-- Login/Register & Cart Button -->
                                <div class="login-register-cart-button d-flex align-items-center">
                                    <!-- Login/Register -->
                                    
                                    <!-- Cart Button -->
                                    <div class="cart-btn">
                                        <p><span class="icon-shopping-cart"></span> <span class="quantity">1</span></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <section style="margin-top:100px">
        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-4">
                        <?php 
                            if($track['image']=='' || $track['image']==null){
                        ?>
                        <img src="img/tracks/default.jpg" alt=""  class="image-fluid" style="height:500px; width:100%">
                        <?php
                            }else{
                        ?>
                            <img src="<?php echo 'img/tracks/'.$track['image']?>" alt=""  class="image-fluid" style="height:500px; width:100%">
                        <?php        
                            }
                        ?>
                    </div>
                    <div class="col-md-6 pt-5">
                        <h5>Track Detail</h5>
                        <p><b>Name:</b> <?php echo $track['name']?></p>
                        <p><b>Category:</b> <?php echo $track['category']?></p>
                        <p><b>Price:</b> $<?php echo $track['price']?></p>
                        <p><b>Description:</b> <?php echo $track['description']?></p>
                        <div style="width:90%">
                            <audio controls>
                                <!-- <source src="dummy-audio.mp3" type="audio/ogg"> -->
                                <source src="<?php echo 'audio/'.$track['audio']?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <div>
                            <button class="btn btn-dark  bg-dark"> Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ##### Contact Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area mt-5">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-12 col-md-6">
                    <a href="#"><img src="img/core-img/logo.png" alt=""></a>
                </div>

                <div class="col-12 col-md-6">
                    <div class="footer-nav">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>