<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  	<li class="page-item <?php if($page<=1){ echo "disabled"; } ?>">
      <a class="page-link" href="<?php echo $page_url ?>page=1" tabindex="-1">First</a>
    </li>
    <li class="page-item <?php if($page<=1){ echo "disabled"; } ?>">
      <a class="page-link" href="<?php echo $page_url ?>page=<?php echo $page-1; ?>" tabindex="-1">Previous</a>
    </li>
    <?php
    	for($i = $page-1; $i <= $page+1; $i++){
    		if($i > 0 && $i <= $total_pages){
    			?>
					<li class='page-item <?php if($i == $page){ echo 'active'; } ?>'><a class='page-link' href='<?php echo $page_url ?>page=<?php echo $i ?>'><?php echo $i ?></a></li>
			<?php		
    		}
    	} 
     ?>
    <li class="page-item <?php if($page>=$total_pages){ echo "disabled"; } ?>">
      <a class="page-link" href="<?php echo $page_url ?>page=<?php echo $page+1; ?>">Next</a>
    </li>
  	<li class="page-item <?php if($page>=$total_pages){ echo "disabled"; } ?>">
      <a class="page-link" href="<?php echo $page_url ?>page=<?php echo $total_pages; ?>" tabindex="-1">Last</a>
    </li>
  </ul>
</nav>