<?php 
    include "includes/header.php";
 ?>
 <?php 
    if((Session::get('password-reset') === null) || Session::get('password-reset') !== 'password_verified'){
            echo "<script> location.href='verify-user.php'; </script>";
            exit;
    }
  ?>


<?php 
    include "includes/header-nav.php";
    
 ?>
        
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
                        <div class="card">
                            <div class="card-header page-header">
                                <h3>Change Password</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(Session::get('msg')){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php 
                                                echo Session::get('msg'); 
                                            ?>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                     <?php    
                                    } 
                                 ?>

                                 <?php
                                    if(Session::get('success-message')){
                                        ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?php 
                                                echo Session::get('success-message'); 
                                            ?>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                     <?php    
                                    } 
                                 ?>


                                <form action="controllers/PasswordController.php?action=updatePassword" method="POST">
                                  <div class="form-group">
                                    <label for="password">Enter Password</label>
                                    <input type="password" name="password" class="form-control" rows="5" id="password">
                                    <div class="text-danger mt-2">
                                        <strong>                                               
                                            <?php 
                                             Session::error('password')
                                             ?>
                                        </strong>
                                    </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Update Password</button>
                                </form>
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
        Session::set('password-reset', 'password_verified');
     ?>