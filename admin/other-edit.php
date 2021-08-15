<?php 
    include "includes/header.php";
    
 ?>
 <?php 
 $request = $obj->inputValidate($_GET);
    if(isset($request->other_id)){
        $other_id = $request->other_id;
        $query = "SELECT * FROM tbl_others WHERE id=$other_id";
        $others = $db->select($query);
    }else{
        echo "<script> location.href='others.php'; </script>";
        exit;
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
        <?php 
        if($others){
            while($other = $others->fetch_object()){
         ?>
        <div class="content-body">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12">                    
                        <div class="card">
                            <div class="card-header page-header">
                                <h3>Update information</h3>
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
                                    <form action="controllers/OtherController.php?action=update&other_id=<?php echo $other->id ?>" method="POST" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="<?php echo $other->title ?>">
                                        
                                            <div class="text-danger mt-2">
                                                <strong>                                               
                                                    <?php 
                                                     Session::error('title');
                                                     ?>
                                                </strong>  
                                            </div>
                                            
                                      </div>

                                      <div class="form-group">
                                        <label for="slogan">Slogan</label>
                                        <input type="text" name="slogan" class="form-control" id="slogan" value="<?php echo $other->slogan ?>">
                                        
                                            <div class="text-danger mt-2">
                                                <strong>                                               
                                                    <?php 
                                                     Session::error('slogan');
                                                     ?>
                                                </strong>
                                            </div>
                                        
                                      </div>

                                      <div class="form-group">
                                        <label for="copyright">Copyright</label>
                                        <input type="text" name="copyright" class="form-control" id="copyright" value="<?php echo $other->copyright ?>">
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 Session::error('copyright');
                                                 ?>
                                            </strong>
                                        </div>
                                        
                                      </div>
                                      
                                      <div class="form-group">
                                          <label for="logo">Logo</label>
                                          <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input" id="logo">
                                            <label class="custom-file-label" for="customFile"><?php if ($other->logo) {
                                                echo $other->logo;
                                            }else{ echo 'Choose file'; } ?></label>
                                          </div>

                                          <div class="text-danger mt-2">
                                              <strong>                            
                                                  <?php 
                                                    Session::error('logo');
                                                   ?>  
                                              </strong>
                                          </div>
                                      </div>
                                      <button type="submit" class="btn btn-primary">Update information</button>
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
        <?php 
            }
            }else{
                echo "<script> location.href='others.php'; </script>";
                exit;
         }
         ?>
        
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
        $('#logo').change(function(){
            $(this).next('label').text($(this).val());
        })
     </script>