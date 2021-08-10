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
                                <form action="controllers/userController.php?action=insert" method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?php if(Session::get('name')){ echo Session::get('name'); } ?>">
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
                                    <input type="email" name="email" class="form-control" id="email" value="<?php if(Session::get('email')){ echo Session::get('email'); } ?>">
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
                                      <label for="photo">Profile photo</label>
                                      <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input" id="photo" value="<?php if(Session::get('photo')){ echo Session::get('photo'); } ?>">
                                        <label class="custom-file-label" for="customFile"><?php if(Session::get('photo')){ echo Session::get('photo'); }else{ echo 'Choose file'; } ?></label>
                                      </div>
                                      <div class="text-danger mt-2">
                                          <strong>                            
                                              <?php 
                                                if (Session::get('error-photo')) {
                                                    echo Session::get('error-photo');
                                                    Session::unsetSession('error-photo');
                                                }
                                               ?>  
                                          </strong>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea class="form-control" rows="5" name="about" id="about"><?php if(Session::get('about')){ echo Session::get('about'); } ?></textarea>
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
                                  <button type="submit" class="btn btn-primary">Create user</button>
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
        Session::unsetSession('name');
        Session::unsetSession('email');
        Session::unsetSession('photo');
        Session::unsetSession('about');
     ?>
    <?php 
        include "includes/footer.php";
     ?>

    <script>
        $('#photo').change(function(){
            $(this).next('label').text($(this).val());
        })
     </script>