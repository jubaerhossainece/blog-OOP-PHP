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
                                <form action="controllers/UserController.php?action=insert" method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?php Session::old('name') ?>">
                                    <?php
                                        if(Session::get('error-name')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 Session::error('name');
                                                 ?>
                                            </strong>
                                        </div>
                                    <?php  
                                        }   
                                     ?>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="<?php Session::old('email') ?>">
                                    <?php
                                        if(Session::get('error-email')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 Session::error('email');
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
                                        <input type="file" name="photo" class="custom-file-input" id="photo">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                      </div>
                                      <div class="text-danger mt-2">
                                          <strong>                            
                                              <?php 
                                                Session::error('photo');
                                               ?>  
                                          </strong>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="about">About</label>
                                    <textarea class="form-control" rows="5" name="about" id="about"><?php Session::old('about') ?></textarea>
                                  </div>

                                  <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" value="">
                                    <?php
                                        if(Session::get('error-password')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 Session::error('password');
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
        include "includes/footer.php";
     ?>

    <script>
        $('#photo').change(function(){
            $(this).next('label').text($(this).val());
        })
     </script>