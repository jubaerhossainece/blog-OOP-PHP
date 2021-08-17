<?php 
    include "includes/header.php";

    $query = "SELECT * FROM tbl_pages";
    $pages = $db->select($query);
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
                                <h3>Pages</h3>
                                <a href="page-create.php" class="btn btn-primary">Create Page</a>
                            </div>
                            <div class="card-body">
                                <?php 
                                    if (Session::get('msg')) {
                                        ?>
                                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
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


                            <?php 
                                if($pages){
                             ?>
                                <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th class="text-center">Serial</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Body</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                            
                                while ($page = $pages->fetch_object()) {
                                $i = 1;

                                 ?>
                                      <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="text-center"><?php echo $page->name ?></td>
                                        <td class="text-center"><?php echo Format::textShorten($page->body,100) ?></td>
                                        <td class="text-center">
                                            <a href="page-show.php?page_id=<?php echo $page->id ?>" class="btn btn-primary mb-2">Show</a>
                                            <a href="page-edit.php?page_id=<?php echo $page->id ?>" class="btn btn-success mb-2">Edit</a>
                                            <a href="controllers/PageController.php?action=delete&page_id=<?php echo $page->id ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                      </tr>
                                      
                                      <?php 
                                        } 
                                        ?>

                                    </tbody>
                                  </table>
                              <?php 
                                    }else{
                                        echo "<div class='text-center'>No page found!</div>";
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