 <div class="col-lg-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="sidebar-widget search">
                <form action="search.php" method="GET">                
                    <div class="form-group">
                        <input type="text" placeholder="search" name="search" class="form-control">
                        <i class="fa fa-search"></i>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="sidebar-widget about-bar">
                <h5 class="mb-3">About us</h5>
                <p>Nostrum ullam porro iusto. Fugit eveniet sapiente nobis nesciunt velit cum fuga doloremque dignissimos asperiores</p>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="sidebar-widget category">              
                <h5 class="mb-3">Category</h5>

      <?php
            $query = "SELECT * FROM tbl_categories";
            $categories = $db->select($query);
        
            if($categories){
              ?>
            <ul class="list-styled">
              <?php
                while($category = $categories->fetch_object()){
                  $query = "SELECT COUNT(*) as id FROM tbl_posts WHERE category_id = $category->id";
                  $count = $db->select($query)->fetch_object();
                ?>
                <li><a href="posts.php?category_id=<?php echo $category->id ?>" > <?php echo $category->name; ?> <span>(<?php echo $count->id; ?>)</span></a></li>
              <?php
                } 
              ?>
            </ul>
          <?php 
            } 
            ?>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="sidebar-widget tag">
                <a href="#">web</a>
                <a href="#">development</a>
                <a href="#">seo</a>
                <a href="#">marketing</a>
                <a href="#">branding</a>
                <a href="#">web deisgn</a>
                <a href="#">Tutorial</a>
                <a href="#">Tips</a>
                <a href="#">Design trend</a>
            </div>
        </div>
    </div>
</div>