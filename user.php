<?php   
    include "includes/header.php"; 
 ?>
 <link rel="stylesheet" href="assets/css/profile.css">

<!-- fetching user data from database -->
 <?php 
    $req = $obj->inputValidate($_GET);
    if(isset($req->user_id)){
        $user_id = $req->user_id;
        $query = "SELECT * FROM tbl_users where id=$user_id";
        $user = $db->select($query);
        if ($user) {
            $user = $user->fetch_object();
            $query = "SELECT * FROM tbl_posts WHERE author_id=$user->id ORDER BY created_at LIMIT 3";
            $posts = $db->select($query);
        }else{
            echo "<script> location.href='users.php'; </script>";
            exit;
        }
     }else{
        echo "<script> location.href='users.php'; </script>";
        exit;
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
            <div class="col-lg-12">
                <div class="page-content page-container" id="page-content">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="user-photo-section">
                                        <img src="admin/images/users/<?php echo $user->image ? $user->image : 'avatar.png' ?>" alt="">
                                    </div>
                                    <h6 class="f-w-600"></h6>
                                    <p class="mb-1">Web Designer</p> 
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h3 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5 class="m-b-10 f-w-600">Name</h5>
                                            <h6 class=".text-secondary f-w-400"><?php echo $user->name ?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="m-b-10 f-w-600">Email</h5>
                                            <h6 class=".text-secondary f-w-400"><?php echo $user->email ?></h6>
                                        </div>
                                        <div class="col-sm-12 mt-5">
                                            <h5 class="m-b-10 f-w-600">About</h5>
                                            <h6 class=".text-secondary f-w-400"><?php echo $user->about ?></h6>
                                        </div>
                                    </div>

                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content page-container" id="page-content">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Posts</h3>
                            <div class="row">
                        <?php 
                            if($posts){
                                $i=1;
                                while ($post = $posts->fetch_object()) {
                         ?>
                                <div class="col-12 mb-5">
                                    <h5 class="mb-3">
                                        <a href="post.php?post_id=<?php echo $post->id ?>" class="">
                                        <?php echo $i++.") "; echo $post->title ?>
                                        </a> 
                                    </h5>
                                    <p class="mt-3"><?php echo Format::textShorten($post->body, 300); ?></p>
                                    <a href="post.php?post_id=<?php echo $post->id ?>" class="mt-2 btn btn-circled btn-hero">Read More <i class="fa fa-angle-right"></i></a>
                                </div>
                        <?php 
                            }
                        }else{
                        ?> 
                            <div class="">
                                <h4 class="text-center pl-3"><?php echo $user->name ?>, has no post!</h4>
                            </div>  
                        <?php    
                        } 
                         ?>        
                                <!-- <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Most Viewed</p>
                                    <h6 class=".text-secondary f-w-400">Dinoter husainm</h6>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right sidebar starts -->
            
            <!-- right sidebar end --> 
        </div>
    </div>
</section>

<!--  FOOTER AREA START  -->
<?php 
    include "includes/footer.php";
?>
<!--  FOOTER AREA END  -->
