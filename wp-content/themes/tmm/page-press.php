<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar(); ?>

	<div id="blog" class="right-col">
		<?php
		if(isset($_GET['ye']) ) {
			$year = $_GET['ye'];
		}
		else {
			$year = date('Y');
		}

		if(isset($_GET['pa']) ) {
			$offset = 5 * ($_GET['pa']-1);
			$currentPage = $_GET['pa'];
		}
		else {
			$offset = 0;
			$currentPage = 1;
		}

		$sql = "SELECT distinct(YEAR(pm.meta_value)) FROM wp_postmeta pm
					JOIN wp_posts p ON (p.ID = pm.post_id)
					WHERE p.post_status = 'publish'
					AND p.post_type = 'press_content'
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
		?>

		<script>
			function changeYear() {
				window.location = "<?php echo the_permalink()  ?>?ye=" + document.getElementById("yearCombo").value;
			}

			function changePage(p) {
				if(p == <?php echo $currentPage ?>) {
					return;
				}
				window.location = "<?php echo the_permalink() ?>?ye=" + <?php echo $year ?> + "&pa=" + p;
			}
		</script>

		<div id="ctn-full-width">
			<h2 class="cnt-title">Press</h2>
			<div class="select-year">
				<p class="select-label">Select Year:</p>
				<div class="pre-select">
					<select class="pre-select-style" id="yearCombo" onchange="changeYear()">
						<?php foreach($yearList as $y) : ?>
							<option value="<?php echo $y ?>" <?php if ($year==$y) echo 'selected="selected"'?>><?php echo $y ?></option>
						<?php endforeach; ?>		
					</select>
				</div>
			</div>
			<div class="cnt-man">
				<div class="list-press">
					<?php 
					$args = array( 'post_type' => 'press_post',
							'posts_per_page' => 5,
							'offset' => $offset,
							'meta_query' => array(
									'relation' => 'AND',
									array(
						                'key' => 'publish_date',
						                'value' => $year."/01/01",
						                'compare' => '>=',
										'type' => 'DATE'
						            ),
									array(
											'key' => 'publish_date',
											'value' => ($year+1)."/01/01",
											'compare' => '<',
											'type' => 'DATE'
									)
							));
					
					
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					
					$image = get_post_meta(get_the_ID(), 'press_img', true);					
					$imageInfos = wp_get_attachment_image_src($image['ID'],'full');
					
					$attachment = get_post_meta(get_the_ID(), 'press_doc', true);
					$attachmentInfos = wp_get_attachment_url($attachment['ID']);
					
					$publishOn = get_post_meta(get_the_ID(), 'publish_date', true);
					$downloadLabel = get_post_meta(get_the_ID(), 'download_label', true);
					$newsLinkLabel = get_post_meta(get_the_ID(), 'news_link_label', true);
					$newsLink = get_post_meta(get_the_ID(), 'news_link', true);
					$publishOnDate = createDateFromFormat('m/d/Y', $publishOn);
					//PRINT_r(date('Y-m-d',$publishOnDate));EXIT;
					?>
					<div class="sub-event">
						<div class="sub-event-left">
							<img alt="" width="287" height="185"
								src="<?php echo $imageInfos[0]; ?>" />
						</div>
						<div class="press-right">
							<div class="press-cnt-right">
								<p class="press-title"><?php echo get_the_title(); ?></p>
								<p class="press-text">Posted on <?php echo $publishOn ?></p>
							</div>
							<?php if ($downloadLabel) :?>
							<div class="press-pdf">
								<a href="<?php echo $attachmentInfos ?>">
									<?php if(empty($downloadLabel)){?>
										Download PDF
									<?php } else { echo $downloadLabel; }?>
								</a>
							</div>
							<?php endif; ?>
							<?php if ($newsLinkLabel) :?>
							<div class="press-link">
							<?php 
								$http = explode(':', $newsLink);
								//$params = explode('.', $newsLink);
								if(strlen($newsLink) != 0) {
								if((strlen($newsLink) != 0) && ($http[0] != "http") && ($http[0] != "https")) {
									$newsLink = "http://" . $newsLink;
								} 
								?>
							   	<a href="<?php echo $newsLink ?>" target="_blank">
							   	<?php if(empty($newsLinkLabel)){?>
							   		Go To News Link
							   	<?php } else { echo $newsLinkLabel;} ?>
							   	</a>
								<?php
								}
								?>								
							</div>
							<?php endif; ?>
						</div>
					</div>
					<?php
					endwhile;
					?>
				</div>
				<div class="press-page">
					<?php 
					// paging
					$sql = "SELECT count(p.ID)
								FROM $wpdb->postmeta pm
								JOIN $wpdb->posts p ON (p.ID = pm.post_id)
								WHERE pm.meta_key = 'publish_date'
								AND pm.meta_value >= '" .$year ."-01-01'
								AND pm.meta_value < '". ($year + 1) . "-01-01'
								AND p.post_type = 'press_post'
								AND p.post_status = 'publish'
							";
					$count = $wpdb->get_var($sql);
					$totalPage = ceil ($count / 5);
					$currentRanges = floor ($currentPage / 5);
					$totalRanges = floor ($totalPage / 5);
					?>
					<ul class="press-pagin">
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


<?php 
function createDateFromFormat($stFormat, $stData)
{
	$aDataRet = array('day' => 0, 'month' => 0, 'year' => 0, 'hour' => 0, 'minute' => 0, 'second' => 0);
	$aPieces = split('[:/.\ \-]', $stFormat);
	$aDatePart = split('[:/.\ \-]', $stData);
	foreach($aPieces as $key=>$chPiece)
	{
		switch ($chPiece)
		{
			case 'd':
			case 'j':
				$aDataRet['day'] = $aDatePart[$key];
				break;
				 
			case 'F':
			case 'M':
			case 'm':
			case 'n':
				$aDataRet['month'] = $aDatePart[$key];
				break;
				 
			case 'o':
			case 'Y':
			case 'y':
				$aDataRet['year'] = $aDatePart[$key];
				break;
				 
			case 'g':
			case 'G':
			case 'h':
			case 'H':
				$aDataRet['hour'] = $aDatePart[$key];
				break;
				 
			case 'i':
				$aDataRet['minute'] = $aDatePart[$key];
				break;
				 
			case 's':
				$aDataRet['second'] = $aDatePart[$key];
				break;
		}
	}
	
	return mktime($aDataRet['hour'], $aDataRet['minute'], $aDataRet['second'] , $aDataRet['month'], $aDataRet['day'], $aDataRet['year'] );	
}
?>
