<?php

session_start();
include_once('db/conn.php');
$success="";
$error="";

if (isset($_POST['submit'])) {
    
    $name=$_POST['name'];
    $category=$_POST['category'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $uid=date("Y-m-d_H:i:s");
    $filename = date("Y-m-d-H-i-s").$_FILES["img"]["name"]; 
    $tempname = $_FILES["img"]["tmp_name"];     
    $folder = "../img/tracks/".$filename;
    $allowed = array('gif', 'png', 'jpg','jpeg');
    $audiofilename = date("Y-m-d-H-i-s").$_FILES["audio"]["name"]; 
    $audiotempname = $_FILES["audio"]["tmp_name"];     
    $audiofolder = "../audio/".$audiofilename;
    $audioallowed = array('mp3', 'audio/mpeg');

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (in_array($ext, $allowed)) {
            if (move_uploaded_file($tempname, $folder)) {
                move_uploaded_file($audiotempname, $audiofolder);
                $sql=mysqli_query($conn,"Insert into tracks(name,category,price,description,image,audio) values('$name','$category','$price','$description','$filename','$audiofilename')");
                if ($sql==true) {
                    $success="Track Added";
                }else{
                    $error="Error: " . $sql . "<br>" . $conn->error;
                }
            }
       
        
            
    }else{
        move_uploaded_file($audiotempname, $audiofolder);
        $sql=mysqli_query($conn,"Insert into tracks(name,category,price,description,audio) values('$name','$category','$price','$description','$audiofilename')");
            if ($sql==true) {
                $success="Track Added";
            }else{
                $error="Error: " . $sql . "<br>" . $conn->error;
            }
    }

}


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
    <title>One Music </title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">

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
                        <a href="index.html" class="nav-brand"><img src="../img/core-img/logo.png" alt=""></a>

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
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li><a href="tracks.php">Tracks</a></li>
                                    <li><a href="profile.php">Profile</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->
    <section style="margin-top:100px">
        <?php 
            if ($success!="") {

        ?>        
                <div class="alert alert-success mt-4 " role="alert" id="alert">
                    
                    <strong>Success! </strong><?php echo $success;?>
                </div> 
        <?php        
                
                $success="";
            }elseif ($error!="") {
        ?>        
                <div class="alert alert-danger mt-4" role="alert" id="alert">
                    
                    <strong>Error! </strong><?php echo $error;?>

                </div> 
        <?php  
                
                $error="";      
            }
        ?>
        <div class="container">
            <h5>Add Tack</h5>
            <div class="card p-3 mt-4"  style="border: 1px solid light-grey; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                <form action="" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="">Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="col-md-4 col-12">
                        <label for="">Category:</label>
                            <input type="text" class="form-control" name="category" placeholder="Category" required>
                        </div>
                        <div class="col-md-4 col-12">
                        <label for="">Price:</label>
                            <input type="text" class="form-control" name="price" placeholder="Price" required>
                        </div>
                        <div class="col-md-12 col-12">
                        <label for="">Description:</label>
                            <textarea class="form-control" name="description" rows="5" placeholder="Description"></textarea>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="">Image:</label>
                            <input type="file" class="form-control-file" name="img"/>  
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="">Audio Track File:</label>
                            <input type="file" class="form-control-file" name="audio" required/>  
                        </div>
                        <div class="col-md-12 col-12 mt-5">
                            <center><button class="btn btn-dark"  type="submit" name="submit"> Add Track</button></center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/active.js"></script>
    <script>setTimeout(()=> {
            $('#alert').hide('slow')
        }, 5000)</script>
</body>

</html>