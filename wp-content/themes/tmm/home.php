<!DOCTYPE HTML>
<html>
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<link REL="SHORTCUT ICON"
	href="<?php echo IMAGES?>/midnight_mission.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=1100" />

<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

<style>

@font-face {
	font-family: 'flexslider-icon';
	src:url('/wp-content/themes/tmm/css/font/flexslider-icon.eot');
	src:url('/wp-content/themes/tmm/css/font/flexslider-icon.eot?#iefix') format('embedded-opentype'),
		url('/wp-content/themes/tmm/css/font/flexslider-icon.woff') format('woff'),
		url('/wp-content/themes/tmm/css/font/flexslider-icon.ttf') format('truetype'),
		url('/wp-content/themes/tmm/css/font/flexslider-icon.svg#flexslider-icon') format('svg');
	font-weight: normal;
	font-style: normal;
}

</style>

<link rel="stylesheet" type="text/css" href="wp-content/themes/tmm/css/jquery.mCustomScrollbar.css"/>
<link rel="stylesheet" type="text/css" href="wp-content/themes/tmm/css/flexslider.css"/>
<link rel="stylesheet" type="text/css" href="wp-content/themes/tmm/css/responsive.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="wp-content/themes/tmm/css/jpreloader.css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script type="text/javascript" src="wp-content/themes/tmm/js/jpreloader.js"></script>

<script
	src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.6/TweenMax.min.js"></script>

<script type="text/javascript" src="wp-content/themes/tmm/js/blur.min.js"></script>
<script type="text/javascript" src="wp-content/themes/tmm/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="wp-content/themes/tmm/js/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript">
	<?php 
		if( isset($_GET['home']) ) {
			echo 'var reloadSite = 1;';
		} else {
			echo 'var reloadSite = 0;';
		}
	?>
</script>
<script type="text/javascript" src="wp-content/themes/tmm/js/main.js"></script>
<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>

<?php wp_head(); ?>

</head>

<body>
	<img alt="" src="/wp-content/themes/tmm/images/home/home_bar.png" style="display: none">
	<img alt="" src="/wp-content/themes/tmm/images/home/background-slider.jpg" style="display: none">
	<div class="wrap">
		<header>
			<div class="header-top">
				<?php
				$newsletter = get_option('tmm_newsletter');
				$facebook = get_option('tmm_facebook');
				$twitter = get_option('tmm_twitter');
				$youtube = get_option('tmm_youtube');
	
				$stories = get_option('tmm_stories');
				?>
				
				<div class="container">
					
					<a class="logo" href="<?php echo get_site_url()?>?home=true"><img
						src="/wp-content/themes/tmm/images/logo.png"
						alt="<?php bloginfo('name'); ?>" /> </a>
				
					<ul class="social">
						<li><p style="line-height: 100%; margin: 0; padding-right: 5px;">
						<a href="<?php print $newsletter; ?>">&#9658;
								SIGN UP FOR OUR NEWSLETTER</a></p></li>
						<?php if($facebook): ?>
						<li><a class="facebook" target="_blank" href="<?php print $facebook; ?>"></a></li>
						<?php endif; ?>
						<?php if($twitter): ?>
						<li><a class="twitter" target="_blank" href="<?php print $twitter; ?>"></a></li>
						<?php endif; ?>
						<?php if($youtube): ?>
						<li><a class="youtube" target="_blank" href="<?php print $youtube ?>"></a></li>
						<?php endif; ?>
					</ul>
					
					<?php $menu_slug = get_post_meta($post->ID, 'menu', true); ?>				
					<ul class="main-menu">
						<li
							class="<?php if($menu_slug == 'get-involved') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-492"
							id="menu-item-492"><a style="font-family: 'Clarendon'; font-size: 16px !important;"
							href="<?php echo get_site_url()?>/get-involved/get-involved-1/">Get
								Involved</a></li>
						<li
							class="<?php if($menu_slug == 'program-services') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-493"
							id="menu-item-493"><a style="font-family: 'Clarendon'; font-size: 16px !important;"
							href="<?php echo get_site_url()?>/program-services/addiction-treatment/">Program
								Services</a></li>
						<li
							class="<?php if($menu_slug == 'news-events') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-494"
							id="menu-item-494"><a style="font-family: 'Clarendon'; font-size: 16px !important;"
							href="<?php echo get_site_url()?>/news-events/press/">News &amp;
								Events</a></li>
						<li
							class="<?php if($menu_slug == 'about') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-495"
							id="menu-item-495"><a
							href="<?php echo get_site_url()?>/about/mission-statement/">About</a>
						</li>
						<li
							class="<?php if($menu_slug == 'contact') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page lasted menu-item-496"
							id="menu-item-496"><a
							href="<?php echo get_site_url()?>/contact/info/">Contact</a></li>
					</ul>
					
				</div>
			</div>
			<div class="header-bottom">
				<div class="container">
					<ul class="header-buttons">
						<li><a class="donate" target="_blank"
							href="<?php echo get_option('tmm_e_donate') ?>"></a></li>
						<li><a class="volunteer"
							href="<?php echo get_option('tmm_volunteer') ?>"></a></li>
						<li><a  class="get-help" target="_blank"
							href="<?php echo get_permalink($getHelpPage->ID) ?>"></a></li>
						<li><a class="stories" href="http://themidnightmission.tumblr.com/"></a></li>
					</ul>
				</div>
			</div>
		</header>
		
		<div class="home-content wrap">
			<?php 
			$page_id = get_the_id('Home Content');
			$page_home = get_page_by_title('Home Content');
			echo do_shortcode ($page_home->post_content);
			?>
		</div>
		
		<a id="startup-video" class="popup-youtube" href="http://www.youtube.com/watch?v=mmMs9NHCePo" style="display: none;"></a>
		<?php get_footer(); ?>
	</div>
	
	<?php wp_footer(); ?> 
</body>
</html>
