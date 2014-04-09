<?php get_header(); ?>

<div id="main" class="group fourohfour">
	<div id="page-error">
		<h2>Page not Found!?</h2>
		<img alt="page not found" src="<?php echo IMAGES?>/page_not_found.jpg">
		<p>
			I am just as surprised as you are! Maybe we should just move along
			back to the <a href="<?php bloginfo('home'); ?>">home page</a>.
		</p>
	</div>
</div>

		</div>
		<!-- End Main Area -->
		</div>
		<!--end container-->
	</div>
	<!--Footer Information-->
	<?php get_footer(); ?>
	<!-- End Footer Information -->
	 <?php wp_footer(); ?> 
	 <?php //print get_option('director_analytics'); ?>
</body>
</html>