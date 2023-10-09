<?php

session_start();
include_once('db/conn.php');
$success="";
$error="";
$id=$_GET['id'];


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
    
    $audio_filename = date("Y-m-d-H-i-s").$_FILES["audio"]["name"]; 
    $audio_tempname = $_FILES["audio"]["tmp_name"];     
    $audio_folder = "../audio/".$audio_filename;
    $audio_allowed = array('mp3', 'ogg');

    $audioext = pathinfo($audio_filename, PATHINFO_EXTENSION);
    
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (in_array($ext, $allowed)) {
            if (move_uploaded_file($tempname, $folder)) {

                // ---------------checking audio file extenion----------------
                if(in_array($audioext, $audio_allowed)){
                    if (move_uploaded_file($audio_tempname, $audio_folder)){
                        $sql=mysqli_query($conn,"UPDATE tracks SET name='$name',category='$category',price='$price',description='$description',image='$filename',audio='$audio_filename' WHERE id='$id'");
                        if ($sql==true) {
                            $success="Track Updated";
                        }else{
                            $error="Error: " . $sql . "<br>" . $conn->error;
                        }
                    }else{
                        $error="Error while saving audio file";
                    }
                }else{ //-------------if file is not mp3----------------------
                    $sql=mysqli_query($conn,"UPDATE tracks SET name='$name',category='$category',price='$price',description='$description',image='$filename' WHERE id='$id'");
                    if ($sql==true) {
                        $success="Track Updated";
                    }else{
                        $error="Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
       
        
            
    }else{
        // echo $audioext;
        if(in_array($audioext, $audio_allowed)){
            
            if (move_uploaded_file($audio_tempname, $audio_folder)){
                $sql=mysqli_query($conn,"UPDATE tracks SET name='$name',category='$category',price='$price',description='$description',audio='$audio_filename' WHERE id='$id'");
                if ($sql==true) {
                    $success="Track Updated";
                }else{
                    $error="Error: " . $sql . "<br>" . $conn->error;
                }
            }else{
                $error="Error while saving audio file";
            }
        }else{ //-------------if file is not mp3----------------------
            $sql=mysqli_query($conn,"UPDATE tracks   SET name='$name',category='$category',price='$price',description='$description' WHERE id='$id'");
            if ($sql==true) {
                $success="Track Updated";
            }else{
                $error="Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // $sql=mysqli_query($conn,"UPDATE tracks   SET name='$name',category='$category',price='$price',description='$description' WHERE id='$id'");
        //     if ($sql==true) {
        //         $success="Track Updated";
        //     }else{
        //         $error="Error: " . $sql . "<br>" . $conn->error;
        //     }
    }

}


$track=mysqli_fetch_assoc(mysqli_query($conn,"select * from tracks where id='$id'"));


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
            <h5>Edit Tack</h5>
            <div class="card p-3 mt-4"  style="border: 1px solid light-grey; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <label for="">Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $track['name']?>">
                        </div>
                        <div class="col-md-4 col-12">
                        <label for="">Category:</label>
                            <input type="text" class="form-control" name="category" placeholder="Category" value="<?php echo $track['category']?>">
                        </div>
                        <div class="col-md-4 col-12">
                        <label for="">Price:</label>
                            <input type="text" class="form-control" name="price" placeholder="Price" value="<?php echo $track['price']?>">
                        </div>
                        <div class="col-md-12 col-12">
                        <label for="">Description:</label>
                            <textarea class="form-control" name="description" rows="5" placeholder="Description" required><?php echo $track['description']?></textarea>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="">Image:</label>
                            <input type="file" class="form-control-file" name="img" ></input>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="">Image:</label>
                            <input type="file" class="form-control-file" name="audio"></input>
                        </div>
                        <div class="col-md-12 col-12 mt-5">
                            <center><button class="btn btn-dark" name="submit" type="submit">Update Track</button></center>
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