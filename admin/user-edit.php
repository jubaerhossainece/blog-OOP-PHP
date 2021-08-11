<?php 
    include "includes/header.php";
    
 ?>
 <?php 
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $query = "SELECT * FROM tbl_users WHERE id=$user_id";
        $users = $db->select($query);
    }
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
                                <h3>Update user information</h3>
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
                                 

                                    if(mysqli_num_rows($users) > 0){
                                        while($user = $users->fetch_object()){
                                  ?>
                                    <form action="controllers/UserController.php?action=update&user_id=<?php echo $user->id ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="<?php echo  $user_id ?>">
                                        </div>
                                      <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="<?php echo $user->name ?>">
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
                                            <?php } ?>  
                                      </div>

                                      <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $user->email ?>">
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
                                            <input type="file" name="photo" class="custom-file-input" id="photo">
                                            <label class="custom-file-label" for="customFile"><?php if ($user->image) {
                                                echo $user->image;
                                            }else{ echo 'Choose file'; } ?></label>
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
                                        <textarea class="form-control" rows="5" name="about" id="about"><?php echo $user->about ?></textarea>
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
                                                     echo Session::get('error-password');
                                                     Session::unsetSession('error-password');
                                                     ?>
                                                </strong>
                                            </div>
                                        <?php  
                                            }   
                                         ?>
                                      </div>
                                      <button type="submit" class="btn btn-primary">Update user</button>
                                    </form>
                                <?php 
                                    }
                                    }else{
                                    echo "<div class='text-center'>No user data found!</div>";
                                 }
                                 ?>
                                   
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