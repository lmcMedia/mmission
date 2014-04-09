<?php

get_header(); ?>

<section id="primary" class="site-content">
	<div id="content" role="main">
		Archive
		<?php if ( have_posts() ) : ?>
		<header class="archive-header">
			<h1 class="archive-title">
				Arc xxx
				<?php
				if ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
				elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
				elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
				else :
				_e( 'Archives', 'twentytwelve' );
				endif;
				?>
			</h1>
		</header>
		<!-- .archive-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

		/* Include the post format-specific template for the content. If you want to
		 * this in a child theme then include a file called called content-___.php
		* (where ___ is the post format) and that will be used instead.
		*/
		the_title();
		get_template_part( 'content', get_post_format() );

		endwhile;

		?>

		<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

	</div>
	<!-- #content -->
</section>
<!-- #primary -->

<?php get_sidebar(); ?>
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