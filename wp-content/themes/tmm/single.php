<?php get_header(); ?>
<div id="main" class="group">
	<?php get_sidebar(); ?>
	<div id="blog" class="right-col archives">
		<div id="blog-ctn">
		<?php 
		// Get page blog
		$page_blog = get_page_by_title('Blog');
		//Get link page blog
		$page_blog_link = get_permalink($page_blog->ID);
		?>
			<a href="<?php echo $page_blog_link ?>" class="blog-back">Back to list</a>
			<h2 class="cnt-title">Blog</h2>
			<div class="cnt-man">
				<div class="blog-list">
					<div class="blog-sub">
						<?php echo getBlog() ?>
						<div class="blog-cnt-1">
							<div class="blog-share-1">
								<ul>
									<li class="sh-text">SHARE: </li>
									<li><a href="#"><img alt="" src="<?php echo IMAGES ?>/blog_icon_1.png" /></a></li>
									<li><a href="#"><img alt="" src="<?php echo IMAGES ?>/blog_icon_2.png" /></a></li>
									<li><a href="#"><img alt="" src="<?php echo IMAGES ?>/blog_icon_3.png" /></a></li>
									<li><a href="#"><img alt="" src="<?php echo IMAGES ?>/blog_icon_4.png" /></a></li>
									<li><a href="#"><img alt="" src="<?php echo IMAGES ?>/blog_icon_5.png" /></a></li>
									<li><a href="#"><img alt="" src="<?php echo IMAGES ?>/blog_icon_6.png" /></a></li>
									<li><a href="#"><img alt="" src="<?php echo IMAGES ?>/blog_icon_7.png" /></a></li>
								</ul>
							</div>
						</div>
						<?php //echo comment_form(); ?>
						<?php //get_comment_new(); ?>
						<?php comments_template() ?>
					</div>
				</div>
				
			</div>
		</div>
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
function getBlog() {
	$blog_cnt = '';
	//$args = array( 'post_type' => 'blog_content', 'posts_per_page' => 5, 'offset' => 0 );
	//$loop = new WP_Query( $args );
	if (have_posts()): while (have_posts()) : the_post(); {
		
	
	//while ( $loop->have_posts() ) : $loop->the_post();
	// Get post date
	$post_date = get_the_date('d_m');
	$myarr = split('_', $post_date);
	$blog_cnt .= '<p class="blog-time">'. monthAbbreviation($myarr[1]) .'<br />';
	$blog_cnt .= '<span class="text-bold">'. $myarr[0] .'</span></p>';
	$blog_cnt .= '<div class="blog-sub-content">';
	// Get blog title
	$blog_cnt .= '<p class="blog-sub-title">'. get_the_title() .'</p>';
	//Get blog author
	$blog_cnt .= '<p class="blog-sub-name">'. get_the_author() .'</p>';
	// Get blog content
	$blog_cnt .= '<div class="blog-sub-info">'. get_the_content() .'</div>';
	$blog_cnt .= '</div>';
	}
	endwhile; 
	
	else : 
	$blog_cnt = '<p>'. _e('No posts were found. Sorry!') .'</p>';
	endif;
	
	return $blog_cnt;
}
?>
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




