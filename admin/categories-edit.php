<?php 
    include "includes/header.php";

    if(isset($_GET['category_id'])){
        $cat_id = $_GET['category_id'];
        $query = "SELECT * FROM tbl_categories WHERE id = $cat_id";
        $categories = $db->select($query);
    }else{
        echo "<script> location.href='categories.php'; </script>";
        exit;
    }
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
<?php 
    if($categories){
        while($category = $categories->fetch_object()){
            ?>
        <div class="content-body">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12">                    
                        <div class="card">
                            <div class="card-header page-header">
                                <h3>Edit category</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(Session::get('msg')){
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo Session::get('msg');
                                             Session::unsetSession('msg'); ?>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                     <?php    
                                    } 
                                 ?>
                                <form action="controllers/CategoryController.php?action=update&cat_id=<?php echo $category->id ?>" method="POST">
                                  <div class="form-group">
                                    <label for="name">Category Name:</label>
                                    <input type="text" name="name" value="<?php if($category){ echo $category->name; } ?>" class="form-control" id="name">
                                    <div class="text-danger mt-2">
                                        <?php 
                                         Session::error('name');
                                         ?>
                                    </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Update</button>
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
        echo "<script> location.href='categories.php'; </script>";
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