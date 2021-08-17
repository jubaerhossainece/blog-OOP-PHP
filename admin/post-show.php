<?php 
    include "includes/header.php";

		if(!isset($_GET['post_id']) || $_GET['post_id'] == NULL){
			header("Location:404.php");
		}else{
			$id = $_GET['post_id'];
		}

		$query = "SELECT * FROM tbl_posts WHERE id = $id";
		$post = $db->select($query);
		if($post){
			$post = $post->fetch_object();
			$query = "SELECT * FROM tbl_users WHERE id=$post->author_id";
			$user = $db->select($query)->fetch_object();
		}else{
      echo "<script> location.href='posts.php'; </script>";
      exit;
		}
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
            	<div class="card">
            		<div class="card-body">
					    		<div class="row d-flex">
					    			<div class="col-lg-9 px-md-5">
					    				<div class="row">
					    					<div class="post-container">
						    					<h1 class="mb-2"><?php echo $post->title ?></h1>
						    					<p class="mb-2">Posted on - <?php echo Format::formatDate($post->created_at) ?><i class="fas fa-user mr-1 ml-2"></i> by - <a href="user-show.php?user_id=<?php echo $user->id ?>" class="text-primary"><?php echo $user->name ?></a></p>
						    					<p class="border-bottom"></p>
						    					<p></p>
						    					<div class="post-body">
							              		<?php if ($post->image) {
							              		 ?><img src="images/posts/<?php echo $post->image ?>" alt="" class="post-img img-fluid">
							              		<?php } ?>
					    						  <p class="mt-4"><?php echo $post->body ?></p>		    									            
						    					</div>		            
					    					</div>
							    		</div><!-- END-->
							    	</div>

							    	<div class="col-lg-3">
							            <div class="tag-widget post-tag-container mb-1 mt-1">
							            	<h3 class="mt-3">Tags</h3>
								            <div class="tagcloud">
								              	<?php
								              	 if($post->tags!==''){
								              	 $tags = explode(",", $post->tags);
								              	 foreach ($tags as $tag) {
								              	?>
									                <a href="#" class="btn btn-primary p-2" class="tag-cloud-link">
									              	<?php echo $tag ?>
									              	</a>
								            <?php }} ?>
								            </div>
							            </div>	
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