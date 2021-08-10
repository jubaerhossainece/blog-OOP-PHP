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

    $query = "SELECT * FROM tbl_posts LIMIT $from, $per_page";
    $posts = $db->select($query);
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
                            <div class="card-body">
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
                                        if(mysqli_num_rows($posts) > 0){
                                            
                                            while ($post = $posts->fetch_object()) {
                                            $from++;
                                     ?>
                                      <tr>
                                        <td class="text-center"><?php echo $from ?></td>
                                        <td class="text-center"><?php echo $post->title ?></td>
                                        <td class="text-center"><?php echo Format::textShorten($post->body,100) ?></td>
                                        <td class="text-center">
                                            <a href="post-edit.php?post_id=<?php echo $post->id ?>" class="btn btn-success mb-2">Edit</a>
                                            <a href="controllers/PostController.php?action=delete&post_id=<?php echo $post->id ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                      </tr>
                                      <?php 
                                                }
                                            }else{
                                                echo "<div class='text-center'>No users found</div>";
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