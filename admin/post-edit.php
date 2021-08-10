<?php 
    include "includes/header.php";
    
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
                                <h3>Add new user</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(Session::get('msg')){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo Session::get('msg'); 
                                            Session::unsetSession('msg');
                                            ?>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                     <?php    
                                    } 
                                 ?>
                                <form action="controllers/PostController.php?action=insert" method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                    <?php
                                        if(Session::get('error-name')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 echo Session::get('error-name');
                                                 Session::unsetSession('error-name');
                                                 ?>
                                            </strong>
                                        </div>
                                    <?php  
                                        }   
                                     ?>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                    <?php
                                        if(Session::get('error-email')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 echo Session::get('error-email');
                                                 Session::unsetSession('error-email');
                                                 ?>
                                            </strong>
                                        </div>
                                    <?php  
                                        }   
                                     ?>
                                  </div>

                                  <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea class="form-control" name="about" id="about"></textarea>
                                  </div>

                                  <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                    <?php
                                        if(Session::get('error-password')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 echo Session::get('error-password');
                                                 Session::unsetSession('error-password');
                                                 ?>
                                            </strong>
                                        </div>
                                    <?php  
                                        }   
                                     ?>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Create post</button>
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
     ?>