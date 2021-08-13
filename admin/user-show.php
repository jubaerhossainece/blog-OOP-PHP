<?php 
    include "includes/header.php";
    
 ?>

 <!-- fetching user data from database -->
 <?php 
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $query = "SELECT * FROM tbl_users where id=$user_id";
        $user = $db->select($query);
        if ($user) {
            $user = $user->fetch_object();
        }else{
            echo "<script> location.href='users.php'; </script>";
            exit;
        }
    }else{
        echo "<script> location.href='users.php'; </script>";
        exit;
    }
  ?>
 <!-- end of fetching user data --> 
 <link rel="stylesheet" href="assets/css/profile.css">

        
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php 
            include "includes/sidebar.php";
         ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="page-content page-container" id="page-content">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-4 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="circle-cropper" style="background-image: url(<?php $user->image ? echo '/images/users/'.$user->image : echo 'assets/images/avatar-4.png' ?>)">
                                            </div>
                                            <h6 class="f-w-600"></h6>
                                            <p>Web Designer</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="card-block">
                                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Name</p>
                                                    <h6 class="text-muted f-w-400"><?php echo $user->name ?></h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Email</p>
                                                    <h6 class="text-muted f-w-400"><?php echo $user->email ?></h6>
                                                </div>
                                                <div class="col-sm-12">
                                                    <p class="m-b-10 f-w-600">About</p>
                                                    <h6 class="text-muted f-w-400"><?php echo $user->about ?></h6>
                                                </div>
                                            </div>

                                            <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                                <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-content page-container" id="page-content">                        
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Posts</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Recent</p>
                                            <h6 class="text-muted f-w-400">Sam Disuja</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Most Viewed</p>
                                            <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <?php 
        include "includes/footer.php";
     ?>