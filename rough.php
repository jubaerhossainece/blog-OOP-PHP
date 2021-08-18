


  <?php 
    include "includes/header.php";
 ?>
  <body>

    <div id="colorlib-page">
        <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
        <?php 
            include "includes/left-sidebar.php";

            if(!isset($_GET['post_id']) || $_GET['post_id'] == NULL){
                header("Location:404.php");
            }else{
                $id = $_GET['post_id'];
            }

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
         <!-- END COLORLIB-ASIDE -->
        <div id="colorlib-main">
            <section class="ftco-section ftco-no-pt ftco-no-pb">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-lg-9 px-md-5">
                        <div class="row pt-md-4">
                            <div class="post-container pt-4">
                                <h1 class="mb-2"><?php echo $post->title ?></h1>
                                <p class="mb-1">Published at - <?php echo Format::formatDate($post->created_at) ?></p>
                                <p class="border-bottom"></p>
                                <div class="post-body">
                          <img src="admin/images/posts/<?php echo $post->image ?>" alt="" class="post-img img-fluid">                                       
                                  <p class="mt-3"><?php echo $post->body ?></p>                                                         
                                </div>                      
                            </div>
                   
                    <div class="tag-widget post-tag-container mb-1 mt-1">
                      <div class="tagcloud">
                        <?php echo $post->tags ?>
                        <a href="#" class="tag-cloud-link">Life</a>
                      </div>
                    </div>
                    

                    <!-- releted post section below here -->
                    
                    <div class="container releted-post p-4 mb-4 bg-light">
                        <div class="post-header border-bottom mb-3">
                            <h2>Releted posts</h2>                          
                        </div>
                        <div class="related-post-box row">
                            <?php
                            if($related_posts){
                            while ($related_post = $related_posts->fetch_object()) {
                                ?>                      
                          <div class="bio col-md-4">
                            <a href="post.php?post_id=<?php echo $related_post->id ?>">
                            <img src="admin/images/posts/<?php echo $related_post->image ?>" alt="Image placeholder" class="related-post-img img-fluid mb-4 bordered"></a>
                          </div>
                         <?php
                         }
                        }else{
                            ?>
                            <div class="bio">
                            <h4 class="text-danger">No related post to show!</h4>
                          </div>
                          <?php
                                } 
                          ?> 
                        </div>
                    </div>
               
                    <!-- end of related posts -->

                    <!-- post author section -->
                    <div class="about-author p-4 bg-light">
                        <div class="author-header border-bottom mb-3">
                            <h2>About author</h2>                           
                        </div>
                        <div class="author-box row">                        
                          <div class="bio col-md-3">
                            <img src="admin/images/users/<?php echo $user->image ?>" alt="Image placeholder" class="img-fluid mb-4">
                          </div>
                          <div class="desc col-md-9">
                            <a href="user.php?user_id=<?php echo $user->id ?>" class="author-name"><h3 class=""><?php echo  $user->name ?></h3></a>
                            <p><?php echo Format::textShorten($user->about, 200) ?></p>
                          </div>
                        </div>
                    </div>
                    <!-- End post author -->


                    <!-- comment section starts here -->
                    <div class="pt-3 mt-3">
                      <h3 class="mb-3 font-weight-bold">6 Comments</h3>
                      <ul class="comment-list">
                        <li class="comment">
                          <div class="vcard bio">
                            <img src="admin/images/users/person_1.jpg" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>John Doe</h3>
                            <div class="meta">October 03, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                          </div>
                        </li>

                        <li class="comment">
                          <div class="vcard bio">
                            <img src="admin/images/users/person_1.jpg" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>John Doe</h3>
                            <div class="meta">October 03, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                          </div>
                        </li>

                        <li class="comment">
                          <div class="vcard bio">
                            <img src="admin/images/users/person_2.jpg" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>John Doe</h3>
                            <div class="meta">October 03, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                          </div>
                        </li>
                      </ul>
                      <!-- END comment-list -->
                      
                      <!-- comment box section -->
                      <div class="comment-form-wrap">
                        <h3 class="">Leave a comment</h3>
                        <form action="#" class="p-md-2 bg-light">
                          <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="" id="message" cols="30" rows="5" class="comment-box form-control"></textarea>
                          </div>
                          <div class="form-group">
                            <input type="submit" value="Post Comment" class=" btn py-2 px-4 btn-primary">
                          </div>
                        </form>
                      </div>
                      <!-- End comment box -->

                    </div>
                        </div><!-- END-->
                    </div>

                    <!-- right sidebar goes here -->
                    <?php include "includes/right-sidebar.php"; ?>
                    <!-- END COL -->
                </div>
            </div>
        </section>
        </div><!-- END COLORLIB-MAIN -->

        <?php
        } else{
            header("Location:404.php");
        } 
         ?>
    </div><!-- END COLORLIB-PAGE -->

  <?php include "includes/footer.php"; ?>
    
  </body>
</html>