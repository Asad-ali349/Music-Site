<?php

session_start();
include_once('db/conn.php');

if (isset($_SESSION['success']) && isset($_SESSION['error'])) {
    $success=$_SESSION['success'];
    $error=$_SESSION['error'];
}else{
    $success="";
    $error="";   
}
$tracks= mysqli_query($conn,"select * from tracks");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                    <li><a href="index.php">Dashboard</a></li>
                                    <li><a href="contact.php">Tracks</a></li>
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
    <section style="margin-top:150px">
        <?php 
            if ($success!="") {

        ?>        
                <div class="alert alert-success mt-4 " role="alert" id="alert">
                    
                    <strong>Success! </strong><?php echo $success;?>
                </div> 
        <?php        
                $_SESSION['success']="";
                $success="";
            }elseif ($error!="") {
        ?>        
                <div class="alert alert-danger mt-4" role="alert" id="alert">
                    
                    <strong>Error! </strong><?php echo $error;?>

                </div> 
        <?php  
                $_SESSION['error']="";
                $error="";      
            }
        ?>
        <div class="container">
            <h4>All Tracks</h4>
            <div class="d-flex justify-content-end">
                <a href="add_track.php" class="btn btn-dark mb-5"> Add Track</a>
            </div>
            <table class="table">
                <thead class="bg-dark text-white">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Track Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $count=1;
                    while($track=mysqli_fetch_assoc($tracks)){
                ?>
                <tr>
                    <th scope="row"><?php echo $count;?></th>
                    <td><?php echo $track['name'];?></td>
                    <td><?php echo $track['category'];?></td>
                    <td>$<?php echo $track['price'];?></td>
                    <td>
                        <a data-toggle="modal" data-target="#exampleModalLong<?php echo $count;?>"><i class="fa fa-list" style="font-size:22px;margin-right:10px"></i></a>
                        <a href="<?php echo "edit_track.php?id=".$track['id']?>"><i class="fa fa-edit" style="font-size:22px;margin-right:10px"></i></a>
                        <a  onclick="confirm('Are You sure to delete this track')" href="delete.php?id=<?php echo $track['id']?>&table=tracks&page=tracks.php"><i class="fa fa-trash" style="font-size:22px"></i></a>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong<?php echo $count;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Track name: <?php echo $track['name']?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if($track['image']!='' || $track['image']!=null){
                        ?>
                            <img src="<?php echo '../img/tracks/'.$track['image']?>" alt="" style="width:100%;height:500px">
                        <?php    
                        }?>
                        <p><b>Price:</b> <?php echo $track['price']?></p>
                        <p><b>Category:</b> <?php echo $track['category']?></p>
                        <p><b>Description:</b> <?php echo $track['description']?></p>
                        <div>
                            <audio controls>
                                <!-- <source src="dummy-audio.mp3" type="audio/ogg"> -->
                                <source src="<?php echo '../audio/'.$track['audio']?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                <?php
                    $count++;
                    }
                ?>
                </tbody>
            </table>
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