<?php 
    include "includes/header.php";

    /*pagination detail goes below*/ 
    $per_page = 2;

    $query = "SELECT COUNT(id) as total FROM tbl_users";
    $result = $db->select($query)->fetch_object();
    $total_pages = ceil($result->total/$per_page); 
    $page_url = "users.php?";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $from = ($page-1) * $per_page;

    $query = "SELECT * FROM tbl_users LIMIT $from, $per_page";
    $users = $db->select($query);
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
                                <h3>Users Page</h3>
                                <a href="user-create.php" class="btn btn-primary">Add user</a>
                            </div>
                            <div class="card-body">

                                <?php 
                                    if (Session::get('msg')) {
                                        ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if(mysqli_num_rows($users) > 0){
                                            while ($user = $users->fetch_object()) {
                                            $from++;
                                     ?>
                                      <tr>
                                        <td class="text-center"><?php echo $from ?></td>
                                        <td class="text-center"><?php echo $user->name ?></td>
                                        <td class="text-center"><?php echo $user->email ?></td>
                                        <td class="text-center">
                                            <a href="user-edit.php?action=update&user_id=<?php echo $user->id ?>" class="btn btn-success">Edit</a>
                                            <a href="controllers/UserController.php?action=delete&user_id=<?php echo $user->id ?>" class="btn btn-danger">Delete</a>
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