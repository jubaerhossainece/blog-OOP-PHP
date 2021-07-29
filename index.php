<?php	
	include "includes/header.php"; 
 ?>
 <?php
	$per_page = 2;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}

	$from = ($page-1) * $per_page;

	$query = "SELECT * FROM tbl_posts LIMIT $from, $per_page";
	$posts = $db->select($query);
?>
  <body>

	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<?php 
			include "includes/left-sidebar.php";
		 ?>
		<div id="colorlib-main">
			<section class="ftco-section ftco-no-pt ftco-no-pb">
	    	<div class="container">
	    		<div class="row d-flex">
	    			<div class="col-xl-9 px-md-5">
	    			<?php if ($posts) {
	    				?>
	    				<div class="row pt-md-4">

	    					<?php
	    						while($post = $posts->fetch_object()){  
	    							$id = $post->author_id;
	    							$q = "SELECT * FROM tbl_users WHERE id=$id LIMIT 1";
	    							$user = $db->select($q)->fetch_object();	    							
	    					 ?>
	    					<div class="col-md-12">
		    					<div class="blog-entry-2 ftco-animate">
	    							<div class="text pt-4 pb-3 post-border-bottom">
				              <div class="author mb-4 d-flex align-items-center">
				            		<a href="user.php?user_id=<?php echo $user->id ?>" class="img" style="background-image: url(admin/images/users/<?php echo $user->image ?>)"></a>
				            		<div class="ml-3 info">
				            			<span>Written by</span>
				            			<h3><a href="user.php?user_id=<?php echo $user->id ?>"><?php echo $user->name; ?></a>, 
				            				<span>
				            					<?php 
				            						echo Format::formatDate($post->created_at) 
				            					?>		
				            				</span>
				            			</h3>
				            		</div>
				            	</div>

				            	<div>
	    									<a href="post.php?post_id=<?php echo $post->id; ?>" class="img" style="background-image: url(admin/images/posts/<?php echo $post->image ?>)"></a>
					            	<h3 class="mt-4 mb-4">
					            		<a href="#"><?php echo $post->title ?></a></h3>
					              <p class="mb-4">
					              	<?php echo Format::textShorten($post->body, 300) ?>
					              </p>
				            	</div>

				              <div class="meta-wrap d-md-flex align-items-center">
				              	<div class="half">
					              	<p><a href="post.php?post_id=<?php echo $post->id ?>" class="btn btn-primary p-2 px-xl-4 py-xl-2">Continue Reading</a></p>
				              	</div>
				              </div>
				            </div>
	    							
	    						</div>
	    					</div>
	    					<?php 
	    					}
	    					 ?>
	    					
			    		</div><!-- END-->
			    		<div class="row pt-4">
			          <div class="col">
			          	<?php
			          	$query = "SELECT * FROM tbl_posts";
			          	$result = $db->select($query);
			          	$total_rows = mysqli_num_rows($result);
			          	$total_pages = ceil($total_rows/$per_page); 
			          	$page_url = "index.php?";
			          	include "includes/partials/pagination.php";
			          	 ?>
			              
			          </div>
			        </div>

			    	<?php 
			    		
	    					}else{
	    						echo "<div>No post found!</div>";
	    					}
			    	 ?>
			    	</div>

			    	<!-- right sidebar goes below here -->
	            <?php 
	            	include "includes/right-sidebar.php";
	             ?>
	          <!-- END COL -->
	    		</div>
	    	</div>
	    </section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

<?php 
	include "includes/footer.php";
?>
    
  </body>
</html>