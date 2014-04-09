<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar(); ?>

	<div class="right-col" id="blog">
		<div id="ctn-left">
			<h2 class="cnt-title">Special Events</h2>
			<?php 
				$eventPage = get_page_by_title('Events');
			?>
			<div class="cnt-man">
				<div class="list-event">

					<?php

					$args = array( 'post_type' => 'event_content',
							'meta_query' => array(
									array(
											'key' => 'is_special_event',
											'value' => 1,
									)
							) );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();

					$time = get_post_meta(get_the_ID(), 'event_on', true);
					$facebook = get_post_meta(get_the_ID(), 'facebook_link', true);
					$image = get_post_meta(get_the_ID(), 'image_display', true);
					?>
					<div class="sub-event">
						<div class="sub-event-left">
							<img src="<?php echo $image['guid']; ?>" alt="" width="287" height="185">
						</div>
						<div class="sub-event-right">
							<p class="sub-event-right-title">
								<?php echo get_the_title(); ?>
							</p>
							<p class="sub-event-right-text">
								<?php echo get_the_excerpt(); ?>
							</p>
							<a href="<?php echo $facebook ?>" target="_blank" class="spe-see-album">
								See Album on Facebook
							</a>
						</div>
					</div>
					<?php 
					endwhile;
					?>
				</div>
				<div class="event-contact">
					<p class="event-host">Host An Event</p>
					<p class="event-contact-info">
						Interested in hosting an event for The Midnight Mission? <br />Contact
						Us at <span class="text-bold">213-624-9258</span>
					</p>
				</div>
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