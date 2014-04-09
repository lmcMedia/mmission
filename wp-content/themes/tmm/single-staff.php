<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar('staff'); ?>
	<div id="blog" class="right-col archives">
		<div id="staff-ctn">
			<a href="<?php echo get_site_url(); ?>/about/leadership-staff/" class="staff-back">Back</a>
			<h2 class="cnt-title">Board, Senior Staff</h2>
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<div>
					<?php the_content()?>
				</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
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