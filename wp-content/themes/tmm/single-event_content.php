<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar('event'); ?>
	<div id="blog" class="right-col archives">
		<div id="staff-ctn">			
			<a href="<?php echo get_site_url(); ?>/get-involved/special-events/"
				class="staff-back">Back</a>
			<h2 class="cnt-title">Special Events</h2>
			<div class="cnt-man">
				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<h3 class="spe-title">
					<?php the_title()?>
				</h3>
				<div class="spe-event-cnt">
					<?php the_content()?>
				</div>
				<?php $facebook = get_post_meta(get_the_ID(), 'facebook_link', true); ?>
				<div class="spe-link">
					<a href="<?php echo get_site_url(); ?>/news-events/events/"><img alt="event"
						src="<?php echo IMAGES?>/spe_calendar.gif" /> </a> 
					<a href="<?php echo $facebook ?>" target="_blank"><img alt="facebook" 
						src="<?php echo IMAGES?>/spe_facebook.gif" /> </a>
				</div>
				
				<?php endwhile; ?>
				<?php endif; ?>
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