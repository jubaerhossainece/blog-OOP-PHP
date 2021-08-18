<?php   
    include "includes/header.php"; 
 ?>

 <?php 
    if(!isset($_GET['post_id']) || $_GET['post_id'] == NULL){
        header("Location:404.php");
    }else{
        $id = $_GET['post_id'];
    }
 ?> 
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">Blog Details</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, perferendis?</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            $query = "SELECT * FROM tbl_posts WHERE id = $id";
                                $post = $db->select($query);
                                
                            if($post){                  
                                $post = $post->fetch_object();
                                    $user_id = $post->author_id;
                                    $query = "SELECT * FROM tbl_users WHERE id = $user_id";
                                    $user = $db->select($query)->fetch_object();
                                    $related_post_query = "SELECT * FROM tbl_posts WHERE category_id = $post->category_id AND id!=$post->id LIMIT 6";
                                    $related_posts = $db->select($related_post_query); 
                         ?>
                        <div class="blog-post">
                            <?php
                                if($post->image){ 
                             ?>
                            <img src="<?php echo 'admin/images/posts/'.$post->image ?>" alt="" class="img-fluid">
                            <?php } ?>
                            <div class="mt-4 mb-3 d-flex">
                                <div class="post-author mr-3">
                                    <i class="fa fa-user"></i>
                                    <span class="h6 text-uppercase"><?php echo $user->name ?></span>
                                </div>

                                <div class="post-info">
                                    <i class="fa fa-calendar-check"></i>
                                    <span><?php echo Format::formatDate($post->created_at); ?></span>
                                </div>
                            </div>
                            
                            <p class="h4"><?php echo $post->title; ?></p>
                            
                            <p class="mt-3"><?php echo $post->body ?></p>

                        </div>
                        <?php
                         }else{
                            ?>
                            <div class="bio">
                            <h4 class="text-danger">No related post to show!</h4>
                          </div>
                          <?php
                                } 
                          ?>


                        <div class="comments my-4">
                            <h3 class="mb-5">Comments :</h3>

                            <div class="media mb-4">
                                <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
                                <div class="media-body">
                                    <h5>John michele</h5>
                                    <span class="text-muted">20 Jan 2018</span>
                                    <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>

                                    <a href="#" class="reply">Reply <i class="fa fa-reply"></i></a>

                                        <div class="media mt-5">
                                            <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
                                            <div class="media-body">
                                                <h5>John michele</h5>
                                                <span class="text-muted">20 Jan 2018</span>
                                                <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>
        
                                                <a href="#" class="reply">Reply <i class="fa fa-reply"></i></a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="media mb-4">
                                <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
                                <div class="media-body">
                                    <h5>John michele</h5>
                                    <span class="text-muted">20 Jan 2018</span>
                                    <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>

                                    <a href="#" class="reply">Reply <i class="fa fa-reply"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 mb-3">
                            <h3 class="mt-5 mb-2">Leave a comment</h3>
                            <p class="mb-4">We don't spam at your inbox.</p>
                            <form action="#" class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <textarea cols="30" rows="6" class="form-control"  placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <a href="#" class="btn btn-hero btn-circled">Send a message</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right sidebar starts -->
            <?php 
                include "includes/right-sidebar.php";
            ?>
            <!-- right sidebar end --> 
        </div>
    </div>
</section>

<!--  FOOTER AREA START  -->
<?php 
    include "includes/footer.php";
?>
<!--  FOOTER AREA END  -->
