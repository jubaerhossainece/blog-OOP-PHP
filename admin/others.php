<?php 
    include "includes/header.php";

    /*pagination detail goes below*/ 
    $query = "SELECT * FROM tbl_others";
    $others = $db->select($query);
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
                                <h3>Logos and others</h3>
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

                                <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th class="text-center">Serial</th>
                                        <th class="text-center">Website Title</th>
                                        <th class="text-center">Slogan</th>
                                        <th class="text-center">Copyright</th>
                                        <th class="text-center">Logo</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if(mysqli_num_rows($others) > 0){
                                            while ($other = $others->fetch_object()) {
                                     ?>
                                      <tr>
                                        <td class="text-center">#</td>
                                        <td class="text-center"><?php echo $other->title ?></td>
                                        <td class="text-center"><?php echo $other->slogan ?></td>
                                        <td class="text-center"><?php echo $other->copyright ?></td>
                                        <td class="text-center"><?php echo $other->logo ?></td>
                                        <td class="text-center">
                                            <a href="other-edit.php?other_id=<?php echo $other->id ?>" class="btn btn-primary">Edit</a>
                                        </td>
                                      </tr>
                                      <?php 
                                                }
                                            }else{
                                                echo "<div class='text-center'>No data found!</div>";
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