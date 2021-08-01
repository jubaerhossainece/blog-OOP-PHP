<?php 
    include "includes/header.php";
    $query = "SELECT * FROM tbl_users";
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
                                            $i = 0;
                                            while ($user = $users->fetch_object()) {
                                            $i++;
                                     ?>
                                      <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"><?php echo $user->name ?></td>
                                        <td class="text-center"><?php echo $user->email ?></td>
                                        <td class="text-center">
                                            <a href="user-edit.php?user_id=<?php $user->id ?>" class="btn btn-success">Edit</a>
                                            <a href="user-delete.php?user_id=<?php $user->id ?>" class="btn btn-danger">Delete</a>
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