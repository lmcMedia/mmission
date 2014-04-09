<?php
/**
 * Donate Goods step 2
 */
get_header(); ?>
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

<?php //print get_option('director_analytics'); ?>
</body>
</html>