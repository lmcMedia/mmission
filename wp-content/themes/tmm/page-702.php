<?php
get_header();

if($_SERVER['REQUEST_METHOD'] == "POST") {
	session_start();
	$html = "<ol>";
	
	$your_skill = $_POST['vol-your-skill'];
	$opportunities = '';
	for ($i = 1; $i <= 8; $i++){
		if(isset($_POST['vol-chk-'.$i])){
			//$opportunities .= $_POST['vol-chk-'.$i] . "; ";
			$html .= "<li>". $_POST['vol-chk-'.$i] ."</li>";
		}
	}
	
	$html .= "</ol>";
	
	$_SESSION['chk-vol-2'] = $html;
	
	$_SESSION['vol-step-2'] = 	'Volunteering Opportunities: ' . $html . '<br/>' .
								'Your Skills: ' . $your_skill . '<br/>';
}
//echo $_SESSION['vol-step-2'];
?>
<div id="main" class="site-content">
	<div id="content" role="main">
		<?php get_sidebar(); ?>
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

</body>
</html>