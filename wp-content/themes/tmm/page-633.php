<?php get_header(); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$title = 'User: ' . $_POST['first_name'] . ' ' . $_POST['last_name'];

	$content = 'First Name: ' . $_POST['first_name'] . '<br/>' . 
			'Last Name: ' . $_POST['last_name'] . '<br/>' .
			'Phone: ' . $_POST['phone'] . '<br/>' . 
			'Email: ' . $_POST['email'] . '<br/>' .
			'Receive Email: '. ($_POST['chk-receive-email']?"Yes":"No") . '<br/>';
	
	$post = array(
		'post_title'    => wp_strip_all_tags($title),
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_type'	=> 'donate_goods',
	);
	
	wp_insert_post( $post );
	
	$titleEmail = "DONATE GOODS";
	
	$format = 'Hello %s %s, <br/><br/>			
			Thank you for your very generous support of The Midnight Mission. Your donated goods will help to provide life-changing programs and services for homeless men, women and children.<br/>
			Please direct any questions you may have concerning your goods donation to Ana Salazar at <a href="mailto:asalazar@midnightmission.org">asalazar@midnightmission.org</a> or 213-624-9258, X1245.<br/>';
	$bodyEmail = sprintf($format, $_POST['first_name'], $_POST['last_name']);
	
	$headers = 'From: Midnight Mission <noreply@midnightmission.org>' . "\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8";
	
	wp_mail( $_POST['email'], 'Donate Goods', $bodyEmail, $headers );
}

?>

<div id="main" class="site-content">
	<div id="content" role="main">
		<aside class="left-col">
			<div id="mnu-left-img">
				<a href="https://give.cornerstone.cc/The+Midnight+Mission" class="edonate"></a>
				<a href="<?php echo home_url()?>/get-involved/donate-goods/step-1/" class="donate-goods-down"></a>
				<a href="<?php echo home_url()?>/get-involved/planned-giving/" class="planned-giving">
				</a><a href="<?php echo home_url()?>/get-involved/volunteer/step-1/" class="volunteer-left"></a>
			</div>
			<?php
			if(is_nav_menu('get-involved-menu')) {
				print wp_nav_menu(array(
						'menu' => 'get-involved-menu',
						'container_class' => 'menu-left'
				));
			}
			?>
		</aside>
		
		<div class="right-col">
			<div id="map-content">
				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<?php the_content('Read More...'); ?>
				<?php endwhile; else: ?>
				<p>
					<?php _e('No posts were found. Sorry!'); ?>
				</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- #content -->
</div>
<!-- #primary -->


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