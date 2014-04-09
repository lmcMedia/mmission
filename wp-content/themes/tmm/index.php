<?php get_header(); ?>

<div id="main" class="group">
	<?php get_sidebar(); ?>
	<div id="blog" class="right-col">
		
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	
		<div class="post group">
			<h2> inext page<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="byline">by <?php the_author_posts_link(); ?> on <a href="<?php the_permalink(); ?>"><?php the_time('l F d, Y'); ?></a></div>
				<?php the_content('Read More...'); ?>
		</div>
		
		<?php endwhile; else: ?>
			<p><?php _e('No posts were found. Sorry!'); ?></p>
		<?php endif; ?>
		
		<div class="navi">
			<div class="right">
				<?php previous_posts_link('Previous'); ?> / <?php next_posts_link('Next'); ?>
			</div>
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