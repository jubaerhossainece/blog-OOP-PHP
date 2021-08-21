<?php   
    include "includes/header.php"; 
 ?>

 <?php
    $req = $obj->inputValidate($_GET);
     if(isset($req->search) && $req->search !==null){
            $search = $req->search;
     }else{
         header("Location:404.php");
     }

    $per_page = 2;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $from = ($page-1) * $per_page;

    $query = "SELECT * FROM tbl_posts WHERE title LIKE '%$search%' OR body LIKE '%$search%' LIMIT $from, $per_page";

    $posts = $db->select($query);
?>


<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">Latest news</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, perferendis?</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap ">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

            <?php if ($posts) {
                    ?>
                <div class="row">

                <?php
                    while($post = $posts->fetch_object()){  
                        $id = $post->author_id;
                        $q = "SELECT * FROM tbl_users WHERE id=$id LIMIT 1";
                        $user = $db->select($q)->fetch_object();                                    
                 ?>
                    <div class="col-lg-12 border-bottom mb-5">
                        <div class="blog-post">
                            <?php if($post->image){ ?>
                                <img src="<?php echo 'admin/images/posts/'.$post->image ?>" alt="" class="img-fluid">
                            <?php } ?>
                            <div class="mt-4 mb-3 d-flex">
                                <div class="post-author mr-3">
                                    <i class="fa fa-user"></i>
                                    <a href="user.php?user_id=<?php echo $user->id ?>"><span class="text-secondary h6 text-uppercase"><?php echo $user->name ?></span></a>
                                </div>

                                <div class="post-info">
                                    <i class="fa fa-calendar-check"></i>
                                    <span class="text-secondary"><?php echo Format::formatDate($post->created_at); ?></span>
                                </div>
                            </div>
                            <a href="post.php?post_id=<?php echo $post->id ?>" class="h4 "><?php echo $post->title; ?></a>
                            <p class="mt-3"><?php echo Format::textShorten($post->body, 300); ?></p>
                            <a href="post.php?post_id=<?php echo $post->id ?>" class="mt-2 btn btn-circled btn-hero">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>


        
                    <?php 
                    }
                     ?>

                    <div class="row text-center w-100">
                        <div class="col-12">
                      <?php
                        $query = "SELECT * FROM tbl_posts WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
                        $result = $db->select($query);
                        $total_rows = mysqli_num_rows($result);
                        $total_pages = ceil($total_rows/$per_page); 
                        $page_url = "search.php?search=$search&";

                        include "includes/partials/pagination.php";
                     ?>
                              
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                
                    }else{
                        echo "<div>No post found!</div>";
                    }
             ?>

            <!-- right sidebar starts -->
            <?php 
                include "includes/right-sidebar.php";
            ?>
            <!-- right sidebar end -->
        </div>   
    </div>
</section>

<?php 
    include "includes/footer.php";
?>

