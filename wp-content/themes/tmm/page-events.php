<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar(); ?>

	<div id="blog" class="right-col">
		<div id="ctn-full-width-2">
			<?php
			$year = date('Y');
			$month = date('n');
			?>
			<h2 class="cnt-title-event">Events In <?php echo $year?></h2>

			<div class="evt-calendar">
				<?php 
				for ($i = 1; $i <= 12; $i++):
					echo getEvent($i, $year);
				endfor;
				?>
			</div>

			<?php 
			// Get Event by  date
			function getEvent($month, $year){
				$event = '';
				$event_from = '';
				$event_to = '';
				$event_title = '';
				$event_on = '';
				$season_on = '';
				$event_time_other = '';
				$place = '';
				$style_tr = 0;
				
				$args = array( 'post_type' => 'event_content',
				'offset' => $offset,
				'meta_query' => array(
						'relation' => 'AND',
						array(
								'key' => 'event_on',
								'value' => $year .'/'. $month .'/01',
								'compare' => '>=',
								'type' => 'DATE'
						),
						'relation' => 'AND',
						array(
								'key' => 'event_on',
								'value' => $year .'/'. $month .'/31',
								'compare' => '<=',
								'type' => 'DATE'
						)
					));

				$loop = new WP_Query( $args );
				if($loop->have_posts()){
					$event .= '<h2 class="events-title">'. $monthName = date("F", mktime(0, 0, 0, $month, 10)) .'</h2>';
					$event .= '<div class="cal-evt_new-cnt">';
				} else {
					$event .= '<h2 class="events-title">'. $monthName = date("F", mktime(0, 0, 0, $month, 10)) .'</h2>';
					$event .= '<p class="evtents-notfound">No events.</p>';
				}
				
				$num_rows = $loop->found_posts;
				$count = 0;
				while ( $loop->have_posts() ) : $loop->the_post();
					$event_on = get_post_meta(get_the_ID(), 'event_on', true);
					//$season_on = get_post_meta(get_the_ID(), 'season_on', true);
					//$event_from = get_post_meta(get_the_ID(), 'time_from', true);
					//$event_to = get_post_meta(get_the_ID(), 'time_to', true);
					$event_date = get_post_meta(get_the_ID(), 'event_date', true);
					$event_time = get_post_meta(get_the_ID(), 'event_time', true);
					
					//$event_time_other = get_post_meta(get_the_ID(), 'time_oder', true);
					$place = get_post_meta(get_the_ID(), 'place', true);
					$event_title = get_the_title();
					
					if($num_rows > 1) {
						if($count == 0) {
							if($style_tr == 0) {
								$event .= '<ul class="ev-style-1 first">';	
							} else {
								$event .= '<ul class="ev-style-2 first">';
							}
						} else if($count == ($num_rows - 1)) {
							if($style_tr == 0) {
								$event .= '<ul class="ev-style-1 last">';
							} else {
								$event .= '<ul class="ev-style-2 last">';
							}		
						} else {
							if($style_tr == 0) {
								$event .= '<ul class="ev-style-1">';
							} else {
								$event .= '<ul class="ev-style-2">';
							}
						}
					} else {
						$event .= '<ul class="ev-style-1 one-row">';	
					}
					
					$event .= '<li class="col-1">'. $event_title .'</li>';
					if($event_date == '') {
						$event .= '<li class="col-2">'. $event_on .'</li>';
					} else {
						$event .= '<li class="col-2">'. $event_date .'</li>';
					}
					
						$event .= '<li class="col-3">'. $event_time .'</li>';

						
						$event .= '<li class="col-4">'. $place .'</li>';
					$event .= '</ul>';
					$count++;
					if($style_tr == 0) {
						$style_tr = 1;
					} else {
						$style_tr = 0;
					}
				endwhile;
				if($loop->have_posts()){
					$event .= '</div>';
				}
				return $event;
			}?>
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