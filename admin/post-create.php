<?php 
    include "includes/header.php";
 ?>        
 <?php 
    $cat_query = "SELECT * FROM tbl_categories";
    $categories = $db->select($cat_query);
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
                                <h3>Add new post</h3>
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
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    <?php
                                        if(Session::get('error-title')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 echo Session::get('error-title');
                                                 Session::unsetSession('error-title');
                                                 ?>
                                            </strong>
                                        </div>
                                    <?php  
                                        }   
                                     ?>
                                  </div>

                                  <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select a category</option>
                                        <?php
                                        if ($categories) {
                                            
                                            while ($category = $categories->fetch_object()) {
                                        
                                         ?>
                                            <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                         <?php
                                             } 
                                             } 
                                          ?>   
                                    </select>

                                    <?php
                                        if(Session::get('error-category')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 echo Session::get('error-category');
                                                 Session::unsetSession('error-category');
                                                 ?>
                                            </strong>
                                        </div>
                                    <?php  
                                        }   
                                     ?>
                                  </div>
                                      
                                  <div class="form-group">
                                      <label for="photo">Photo</label>
                                      <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input" id="photo">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
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
                                    <label for="tag">Tags</label>
                                    <input name="tag" class="form-control" rows="5" id="tag">
                                  </div>

                                  <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" class="form-control" rows="5" id="body"></textarea>
                                    <?php
                                        if(Session::get('error-body')){
                                        ?>
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 echo Session::get('error-body');
                                                 Session::unsetSession('error-body');
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
     <script>
        $('#photo').change(function(){
            $(this).next('label').text($(this).val());
        })
     </script>