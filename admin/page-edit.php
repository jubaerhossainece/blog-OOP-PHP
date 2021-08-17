<?php 
    include "includes/header.php";
 ?>        
 <?php 
    $req = $obj->inputValidate($_GET);
    if(isset($req->page_id)){
        $page_id = $req->page_id;
        $query = "SELECT * FROM tbl_pages WHERE id=$page_id";
        $pages = $db->select($query);
        if ($pages) {
            $page = $pages->fetch_object();
        }else{
            echo "<script> location.href='pages.php'; </script>";
            exit;
        }
    }else{
        echo "<script> location.href='pages.php'; </script>";
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
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12">                    
                        <div class="card">
                            <div class="card-header page-header">
                                <h3>Edit page</h3>
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
                                <form action="controllers/PageController.php?action=update&page_id=<?php echo $page_id ?>" method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $page->name ?>">
                                        <div class="text-danger mt-2">
                                            <strong>                                               
                                                <?php 
                                                 Session::error('name')
                                                 ?>
                                            </strong>
                                        </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" class="form-control" rows="5" id="body"><?php echo $page->body ?></textarea>
                                    <div class="text-danger mt-2">
                                        <strong>                                               
                                            <?php 
                                             Session::error('body')
                                             ?>
                                        </strong>
                                    </div>
                                  </div>
                                      
                                  <div class="form-group">
                                      <label for="photo">Photo</label>
                                      <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input" id="photo">
                                        <label class="custom-file-label" for="customFile"><?php echo $page->image ? $page->image : 'Choose file' ?>
                                        </label>
                                      </div>
                                      <div class="text-danger mt-2">
                                          <strong>                            
                                              <?php 
                                                Session::error('photo')
                                               ?>  
                                          </strong>
                                      </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Update page</button>
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