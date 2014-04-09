<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar(); ?>
	<div class="right-col">
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		<div id="ctn-left">
			<?php the_content('Read More...'); ?>
			
		</div>
		
		<?php 
			$image = get_post_meta(get_the_ID(), 'feature_image', true); 
			if($image) :
		?>
		<div id="ctn-right">
			<?php $imageInfos = wp_get_attachment_url($image['ID']); ?>
			<div id="ctn-img1">
				<img class="cnt-imgright" alt=""
					src="<?php echo $imageInfos?>" />
			</div>
		</div>
		<?php endif; ?>
		<?php endwhile; else: ?>
		<p>
			<?php _e('No posts were found. Sorry!'); ?>
		</p>
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