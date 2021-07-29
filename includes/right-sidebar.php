<div class="col-lg-3 sidebar ftco-animate bg-light pt-5">
  <div class="sidebar-box pt-md-2">
    <form action="#" class="search-form">
      <div class="form-group">
        <span class="icon icon-search"></span>
        <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
      </div>
    </form>
  </div>
  <div class="sidebar-box ftco-animate">
  	<h3 class="sidebar-heading">Categories</h3>
  	<?php
  		$query = "SELECT * FROM tbl_categories";
  		$categories = $db->select($query);
  	?>
    <ul class="categories">
    	<?php
      if($categories){

      	while($category = $categories->fetch_object()){
      		$query = "SELECT COUNT(*) as id FROM tbl_posts WHERE category_id = $category->id";
      		$count = $db->select($query)->fetch_object();
      	?>
        <li><a href="posts.php?category_id=<?php echo $category->id ?>" > <?php echo $category->name; ?> <span>(<?php echo $count->id; ?>)</span></a></li>
      <?php
        } 
      } 
      ?>
    </ul>
  </div>

  <!-- <div class="sidebar-box ftco-animate">
    <h3 class="sidebar-heading">Popular Articles</h3>
    <div class="block-21 mb-4 d-flex">
      <a class="blog-img mr-4" style="background-image: url(assets/images/image_1.jpg);"></a>
      <div class="text">
        <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control</a></h3>
        <div class="meta">
          <div><a href="#"><span class="icon-calendar"></span> June 28, 2019</a></div>
          <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div>
          <div><a href="#"><span class="icon-chat"></span> 19</a></div>
        </div>
      </div>
    </div>
    <div class="block-21 mb-4 d-flex">
      <a class="blog-img mr-4" style="background-image: url(assets/images/image_2.jpg);"></a>
      <div class="text">
        <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control</a></h3>
        <div class="meta">
          <div><a href="#"><span class="icon-calendar"></span> June 28, 2019</a></div>
          <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div>
          <div><a href="#"><span class="icon-chat"></span> 19</a></div>
        </div>
      </div>
    </div>
    <div class="block-21 mb-4 d-flex">
      <a class="blog-img mr-4" style="background-image: url(assets/images/image_3.jpg);"></a>
      <div class="text">
        <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control</a></h3>
        <div class="meta">
          <div><a href="#"><span class="icon-calendar"></span> June 28, 2019</a></div>
          <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div>
          <div><a href="#"><span class="icon-chat"></span> 19</a></div>
        </div>
      </div>
    </div>
  </div> -->


  <div class="sidebar-box ftco-animate">
  	<h3 class="sidebar-heading">Archives</h3>
    <ul class="categories">
    	<li><a href="#">December 2018 <span>(10)</span></a></li>
      <li><a href="#">September 2018 <span>(6)</span></a></li>
      <li><a href="#">August 2018 <span>(8)</span></a></li>
      <li><a href="#">July 2018 <span>(2)</span></a></li>
      <li><a href="#">June 2018 <span>(7)</span></a></li>
      <li><a href="#">May 2018 <span>(5)</span></a></li>
    </ul>
  </div>
</div>