<?php	
	include "includes/header.php"; 
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
	    			<div class="col-xl-8 px-md-5 py-5 page-404">
	    				<p class="text-danger">404 not found!</p>
			    	</div>
	    			<div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
	            <?php 
	            	include "includes/right-sidebar.php";
	             ?>
	          </div>
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