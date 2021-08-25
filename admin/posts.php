<?php 
    include "includes/header.php";
    
   /*pagination detail goes below*/ 
    $per_page = 2;

    $query = "SELECT COUNT(id) as total FROM tbl_posts";
    $result = $db->select($query)->fetch_object();
    $total_pages = ceil($result->total/$per_page); 
    $page_url = "posts.php?";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $from = ($page-1) * $per_page;

    $query = "SELECT * FROM tbl_posts  LIMIT $from, $per_page";
    $posts = $db->select($query);
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
                                <h3>Posts Page</h3>
                                <a href="post-create.php" class="btn btn-primary">Add post</a>
                            </div>


                            <?php 
                                if($posts){
                             ?>

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
                                <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th class="text-center">Serial</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Body</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        while ($post = $posts->fetch_object()) {
                                        $from++; 
                                    ?>  
                                      <tr>
                                        <td class="text-center"><?php echo $from ?></td>
                                        <td class="text-center"><?php echo $post->title ?></td>
                                        <td class="text-center"><?php echo Format::textShorten($post->body,100) ?></td>
                                        <td class="text-center">
                                            <a href="post-show.php?post_id=<?php echo $post->id ?>" class="btn btn-primary mb-2">Show</a>
                                            <a href="post-edit.php?post_id=<?php echo $post->id ?>" class="btn btn-success mb-2">Edit</a>
                                            <a href="controllers/PostController.php?action=delete&post_id=<?php echo $post->id ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                      </tr>

                                      <?php
                                        } 
                                       ?>
                                       
                                    </tbody>
                                  </table>

                            </div>
                            <div class="card-footer">
                                <?php 

                                    include "includes/pagination.php";
                                 ?>
                            </div>


                      <?php 
                            }else{
                                echo "<div class='card-body text-center'>No posts found</div>";
                            }
                       ?>
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