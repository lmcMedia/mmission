<?php get_header(); ?>

<div id="main" class="group">
	<?php if(is_nav_menu('news-events')) {
			wp_nav_menu(array(
			'menu' => 'news-events'
			));
		}
	?>
	<div id="blog" class="right-col">
		
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	
		<div class="post group">
			<h2>Single-Press : <?php the_title(); ?></h2>
			<div class="byline">
				by <?php the_author_posts_link(); ?> on <span class="date"><?php the_time('l F d, Y'); ?></span><br/>
				Posted in: <?php the_category(', '); ?> | <?php the_tags('Tagged with: ', ', '); ?>
			</div>
				<?php the_content('Read More...'); ?>
		</div>
		
		<div class="navi">
			<div class="right">
				<?php previous_post_link(); ?> / <?php next_post_link(); ?>
			</div>
		</div>

		
		<?php endwhile; else: ?>
			<p><?php _e('No posts were found. Sorry!'); ?></p>
		<?php endif; ?>
		
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