<?php 
/**
 * Page Blog
 * @author TrucESH
 *
 */
?>
<?php get_header(); ?>

<script>
	function changePage(p) {
		window.location = "/news-events/blog/?pa=" + p;
	}
</script>
<div id="main" class="group">
	<?php get_sidebar(); ?>
	<div id="blog" class="right-col archives">
		<div id="blog-ctn">
			<h2 class="cnt-title">Blog</h2>
			<div class="cnt-man">
				<div class="blog-list">
					<?php echo getBlog(); ?>
				</div>
				<div class="press-page">
					<?php 
					// Get current page
					if(isset($_GET['pa']) ) {
						$offset = 5 * ($_GET['pa']-1);
						$currentPage = $_GET['pa'];
					}
					else {
						$offset = 0;
						$currentPage = 1;
					}
					
					// Paging
					$sql = "SELECT count(p.ID)
					FROM $wpdb->posts p
					WHERE p.post_type = 'post'
					AND p.post_status = 'publish'";
					$count = $wpdb->get_var($sql);
					$totalPage = ceil ($count / 5);
					$currentRanges = floor ($currentPage / 5);
					$totalRanges = floor ($totalPage / 5);
					?>
					<ul class="blog-pagin">
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
			<?php

			/**
			 * Get month abbreviation
			 * @param $month
			 * @return month abbreviation
			 */
			function monthAbbreviation ($month){
				$str_month = '';
				switch ($month) {
					case 01: $str_month = 'JAN';
					break;
					case 02: $str_month = 'FEB';
					break;
					case 03: $str_month = 'MAR';
					break;
					case 04: $str_month = 'APR';
					break;
					case 05: $str_month = 'MAY';
					break;
					case 06: $str_month = 'JUNE';
					break;
					case 07: $str_month = 'JULY';
					break;
					case 08: $str_month = 'AUG';
					break;
					case 09: $str_month = 'SEPT';
					break;
					case 10: $str_month = 'OCT';
					break;
					case 11: $str_month = 'NOV';
					break;
					case 12: $str_month = 'DEC';
					break;
					default: $str_month = '';
					break;
				}
				return $str_month;
			}
			
			/**
			 * Get blog
			 * @return string: list blog
			 */
			function getBlog(){
				$blog_cnt = '';
				$args = array( 'post_type' => 'post', 'posts_per_page' => 5, 'offset' => 0 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
				// Get post date
				$post_date = get_the_date('d_m');
				$myarr = split('_', $post_date);
				
				$blog_cnt .= '<div class="blog-sub">';
				$blog_cnt .= '<p class="blog-time">'. monthAbbreviation($myarr[1]) .'<br />';
				$blog_cnt .= '<span class="text-bold">'. $myarr[0] .'</span></p>';
				$blog_cnt .= '<div class="blog-sub-content">';
				// Get blog title
				$blog_cnt .= '<p class="blog-sub-title">'. get_the_title() .'</p>';
				//Get blog author
				$blog_cnt .= '<p class="blog-sub-name">'. get_the_author() .'</p>';
				// Get blog content
				$blog_cnt .= '<div class="blog-sub-info">'. get_the_excerpt() .'</div>';
				$blog_cnt .= '<a href="'.get_permalink().'#comments" class="blog-post-comment">POST A COMMENT
										&rarr;</a> <a href="'.get_permalink().'#share-options" class="blog-share">SHARE ARTICLE
										&rarr;</a>';
				$blog_cnt .= '</div>';
				$blog_cnt .= '</div>';
				endwhile;
				return $blog_cnt;
			}
			?>
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