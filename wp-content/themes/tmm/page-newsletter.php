<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar(); ?>

	<div id="blog" class="right-col">
		<?php
		$post_per_page = 1;
		
		if(isset($_GET['ye']) ) {
			$year = $_GET['ye'];
		}
		else {
			$year = date('Y');
		}

		if(isset($_GET['pa']) ) {
			$offset = $post_per_page * ($_GET['pa'] - 1);
			$currentPage = $_GET['pa'];
		}
		else {
			$offset = 0;
			$currentPage = 1;
		}
		
		$sql = "SELECT distinct(YEAR(pm.meta_value)) FROM wp_postmeta pm
					JOIN wp_posts p ON (p.ID = pm.post_id)
					WHERE p.post_status = 'publish'
					AND p.post_type = 'newsletter_content'
					AND pm.meta_key = 'publish_on'";
			
		$yearList = $wpdb->get_col($sql);

		$flagYear = true;
		foreach($yearList as $y) {
			if($y == date('Y')) {
				$flagYear = false;
			}
		}
	
		if($flagYear) {
			for( $i = count($yearList); $i>0; $i-- ) {
				$yearList[$i] = $yearList[$i-1];
			}
			$yearList[0] = date('Y');
		}
		// paging
		$sql = "SELECT count(p.ID)
		FROM $wpdb->postmeta pm
		JOIN $wpdb->posts p ON (p.ID = pm.post_id)
		WHERE pm.meta_key = 'publish_on'
		AND pm.meta_value >= '" .$year ."-01-01'
		AND pm.meta_value < '". ($year + 1) . "-01-01'
		AND p.post_type = 'newsletter_content'
								AND p.post_status = 'publish'
							";
					$count = $wpdb->get_var($sql);
		$totalPage = ceil ($count / $post_per_page);//13 => $post_per_page = 1
		$currentRanges = floor ( ( $currentPage-1 ) / 5);
		$totalRanges = floor ($totalPage / 5);
		?>

		<script>
			function changeYear() {
				window.location = "<?php echo the_permalink() ?>?ye=" + document.getElementById("yearCombo").value;
			}

			function changePage(p) {
				window.location = "<?php echo the_permalink() ?>?ye=" + <?php echo $year ?> + "&pa=" + p;
			}
		</script>
		<div id="ctn-full-width">
			<h2 class="cnt-title">Newsletter</h2>
			<div class="select-year">
				<p class="select-label">Select Year:</p>
				<div class="new-yearCombo">
					<select id="yearCombo" onchange="changeYear()">
						<?php foreach($yearList as $y) : ?>
							<option value="<?php echo $y ?>" <?php if ($year==$y) echo 'selected="selected"'?>><?php echo $y ?></option>
						<?php endforeach; ?>		
					</select>
				</div>
			</div>
		
			<div class="cnt-man">
				<div class="list-press">
					<?php 
					$args = array( 'post_type' => 'newsletter_content',
							'posts_per_page' => $post_per_page,
							'offset' => $offset,
							'meta_query' => array(
									'relation' => 'AND',
									array(
						                'key' => 'publish_on',
						                'value' => $year."/01/01",
						                'compare' => '>=',
										'type' => 'DATE'
						            ),
									array(
											'key' => 'publish_on',
											'value' => ($year+1)."/01/01",
											'compare' => '<',
											'type' => 'DATE'
									)
							));
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					
						
					$publishOn = get_post_meta(get_the_ID(), 'publish_on', true);
					//$dateObj = date_create_from_format('m/d/Y', $publishOn);
					the_content();
					endwhile;
					?>
				</div>
				<div class="press-page">
					<ul class="news-pagin">
						<?php if($totalPage > 0):?>
						<li class="page-title">Page</li>
						<?php 
						if( $currentRanges > 0 ) {
							if(($currentPage-5) > 0) {
						?>
							<li>
								<a href="#" onclick="changePage(<?php echo $currentPage-5 ?>)">Previous 5 Entries &raquo;</a>
							</li>
						<?php
							} else {
						?>
							<li>
								<a href="#" onclick="changePage(1)">Previous 5 Entries &raquo;</a>
							</li>
						<?php 
							}
						}
						if (($currentRanges*5+5) < $totalPage) {
							$range = $currentRanges*5+5;
							for($i = $currentRanges*5+1; $i <= $range; $i++):
						?>
							<li>
								<a href="#" onclick="changePage(<?php echo $i ?>)" <?php if ($i == $currentPage) echo 'class="page-selected"';?>><?php echo $i ?></a>
							</li>
							<?php 
							endfor;	
						} else {
							$range = $totalPage;
							for($i = $currentRanges*5+1; $i <= $range; $i++):
							?>
							<li>
								<a href="#" onclick="changePage(<?php echo $i ?>)" <?php if ($i == $currentPage) echo 'class="page-selected"';?>><?php echo $i ?></a>
							</li>
							<?php 
							endfor;	
						}
						
						if( $currentRanges < $totalRanges ) {
							if(($currentPage+5) <= $totalPage) {
						?>
							<li>
								<a onclick="changePage(<?php echo ($currentPage+5) ?>,<?php echo $totalPage?>)">Next 5 Entries &raquo;</a>
							</li>
						<?php
							} else {
						?>
							<li>
								<a href="#" onclick="changePage(<?php echo ($totalPage) ?>,<?php echo $totalPage?>)">Next 5 Entries &raquo;</a>
							</li>
						<?php 		
							}
						}
						endif;
						?>
					</ul>
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