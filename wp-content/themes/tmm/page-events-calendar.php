<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar(); ?>

	<div id="blog" class="right-col">
		<div id="ctn-full-width-2">
			<?php
			if(isset($_GET['ye']) ) {
				$year = $_GET['ye'];
			}
			else {
				$year = date('Y');
			}
			if(isset($_GET['mo']) ) {
				$month = $_GET['mo'];
			}
			else {
				$month = date('n');
			}

			if(isset($_GET['pa']) ) {
				$offset = 5 * ($_GET['pa']-1);
				$currentPage = $_GET['pa'];
			}
			else {
				$offset = 0;
				$currentPage = 1;
			}

			?>
			<script>
				function changeDate() {
					var myarr = document.getElementById("dateCombo").value.split("-");
					window.location = "/news-events/events/?ye=" + myarr[0] + "&mo=" + myarr[1];
				}

				function pre() {
					var myarr = document.getElementById("dateCombo").value.split("-");
					var d = new Date();
					var month = d.getMonth()+1;
					var year = d.getFullYear();
					var lit_year = 0;
					var lit_month = 0 ;
					
					if(month != 12){
						lit_year = year - 1;
						lit_month = 14 - (12 - month);
					}
					if((parseInt(myarr[0]) >= lit_year && parseInt(myarr[1]) >= lit_month) || (parseInt(myarr[0]) > lit_year))
					{
						if(myarr[1] == 1){
							window.location = "/news-events/events/?ye=" + (parseInt(myarr[1]) - 1) + "&mo=12";
						} else {
							window.location = "/news-events/events/?ye=" + myarr[0] + "&mo=" + (parseInt(myarr[1])-1);
						}
					}
				}

				function next() {
					var myarr = document.getElementById("dateCombo").value.split("-");
					var d = new Date();
					var n = d.getMonth() + 1;
					var year = d.getFullYear();
					if((parseInt(myarr[1]) < n)||(parseInt(myarr[0]) < year)){
						if(parseInt(myarr[1]) == 12){
							window.location = "/news-events/events/?ye=" + (parseInt(myarr[0]) + 1) + "&mo=1";
						} else {
							window.location = "/news-events/events/?ye=" + myarr[0] + "&mo=" + (parseInt(myarr[1]) + 1);
						}
					}
				}
	
				function changePage(p) {
					window.location = "/news-events/events/?ye=" + $year + "&mo=" + $month + "&pa=" + p;
				}
			</script>

			<?php 
			// get date list
			$dateList = array();
			for ($i = 0; $i< 12; $i++ )
			{
				if( date('m')-$i > 0) {
					$dateList[$i]['y'] = date('Y');
					$dateList[$i]['m'] = date('m') - $i;
				} else {
					$dateList[$i]['y'] = date('Y') - 1;
					$dateList[$i]['m'] = date('m') - $i + 12;
				}
			}
			?>
			<h2 class="cnt-title">Events</h2>
			<div class="evt-title">
				<h1>CALENDAR</h1>
				<ul>
					<li><a href="#"><img src="<?php echo IMAGES?>/evt_icon_pre.png"
							alt="pre" onclick="pre()" /> </a></li>
					<?php 
					$first_of_month = gmmktime(0,0,0,$month,1,$year);
					list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
					$title   = htmlentities(strtoupper(ucfirst($month_name))).'&nbsp;'.$year;
					?>
					<li class="evt-label-date"><?php echo $title ?></li>
					<li><a href="#"><img src="<?php echo IMAGES?>/evt_icon_next.png"
							alt="next" onclick="next()" /> </a></li>
				</ul>
			</div>
			<div class="evt-select">
				<select id="dateCombo" onchange="changeDate()">
					<?php foreach($dateList as $date) : ?>
					<?php $mktime = mktime(0, 0, 0, $date['m'], 1, $date['y']); ?>
					<option value="<?php echo $date['y'].'-'.$date['m'] ?>"
					<?php if($date['y'] == $year && $date['m'] == $month) echo 'selected="selected"'?>>
						<?php echo date("F", $mktime) . ' ' . $date['y'] ?>
					</option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="evt-calendar">
				<?php 
				// Create calendar
				function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $first_day = 0, $pn = array()){
					$first_of_month = gmmktime(0, 0, 0, $month, 1, $year);

					$day_names = array(); #generate all the day names according to the current locale
					for($n = 0, $t = (3+$first_day)*86400; $n < 7; $n++, $t += 86400) { #January 4, 1970 was a Sunday
						$day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name
					}
					
					list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w', $first_of_month));
					$weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day
					$las_month = 0;
					$las_year = 0;
					if($las_month == 1){
						$las_month = 12;
						$las_year = $year - 1;
					} else {
						$las_year = $year;
						$las_month = $month - 1;
					}
					$last_month = gmmktime(0, 0, 0, $las_month, 1, $las_year);
					$days_in_last_month = gmdate('t', $last_month);
					
					// Title calendar
					$calendar = '<ul id="cal-header">'.
							'<li>SUNDAY</li>'.
							'<li>MONDAY</li>'.
							'<li>TUESDAY</li>'.
							'<li>WEDNESDAY</li>'.
							'<li>THURSDAY</li>'.
							'<li>FRIDAY</li>'.
							'<li>SATURDAY</li>'.
							'</ul>';

					$calendar .= '<ul class="cal-row-1 cal-row-style">';
					
					// Last month
					if($weekday > 0) {
						for($i = $weekday; $i > 0; $i--){

							$calendar .= '<li>'.
							'<p class="cal-day">'. ($days_in_last_month - $i + 1) .'</p>'.
								getEvent(($days_in_last_month - $i + 1), ($month-1), $year).
							'</li>';
						}
					}
					
					for($day = 1, $days_in_month = gmdate('t', $first_of_month); $day<=$days_in_month; $day++, $weekday++){
						if($weekday == 7){
							$weekday   = 0; #start a new week
							$calendar .= '</ul><ul class="cal-row-1 cal-row-style">';
						}
						if(isset($days[$day]) and is_array($days[$day])){
							@list($link, $classes, $content) = $days[$day];
							if(is_null($content))  $content  = $day;
							$calendar .= '<li><p class="cal-day">'. $content .'</p></li>';
						}
						else $calendar .= '<li>'.
							'<p class="cal-day">'. $day .'</p>'.
							getEvent($day, $month, $year).
							'</li>';
					}
					
					// Next month
					if($weekday != 7){
						for ($i = 0; $i < 7 - $weekday; $i++){
							$calendar .= '<li>'.
							'<p class="cal-day">'. ($i + 1) .'</p>'.
							getEvent(($i + 1), ($month+1), $year).
							'</li>';
						}
					}
					return $calendar."</ul>";
				}
				echo generate_calendar($year, $month);
				?>

			</div>

			<?php 
			// Get Event by  date
			function getEvent($day, $month, $year){
				$event = '';
				$event_from = '';
				$event_to = '';
				$event_title = '';
				
				$args = array( 'post_type' => 'event_content',
				'offset' => $offset,
				'meta_query' => array(
						'relation' => 'AND',
						array(
								'key' => 'event_on',
								'value' => $year."/".$month."/".$day,
								'compare' => '=',
								'type' => 'DATE'
						)
				));

				$loop = new WP_Query( $args );
				$event .= '<div class="cal-evt-cnt">';
				$event .= '<ul>';
				while ( $loop->have_posts() ) : $loop->the_post();
					$event_from = get_post_meta(get_the_ID(), 'time_from', true);
					$event_to = get_post_meta(get_the_ID(), 'time_to', true);
					$event_title = get_the_title();
					$event .= "<li>". strtoupper($event_from) ."~". strtoupper($event_to) ."<br /><a href='#'>". $event_title ."</a></li>";
				endwhile;
				$event .= '</ul>';
				$event .= '</div>';
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