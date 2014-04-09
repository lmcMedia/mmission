<!DOCTYPE HTML>
<html>
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<link REL="SHORTCUT ICON"
	href="<?php echo IMAGES?>/midnight_mission.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<link rel="stylesheet" type="text/css" href="<?= CSS ?>/magnific-popup.css"  />
<link rel="stylesheet" type="text/css" href="<?= CSS ?>/responsive.css"  />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.6/TweenMax.min.js"></script>
<script type="text/javascript" src="<?= JS ?>/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?= JS ?>/main.js"></script>

<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

</head>

<body id="home-bd">
	<div id="wrap">
		<div id="container">
			<header class="">
				<div class="header_cnt">
					<h1 class="header_logo">
						<a href="<?php echo get_site_url()?>"><img
							src="<?php print IMAGES ?>/logo.png"
							alt="<?php bloginfo('name'); ?>" /> </a>
					</h1>
					<div class="sharing-widget">
						<?php
						$newsletter = get_option('tmm_newsletter');
						$facebook = get_option('tmm_facebook');
						$twitter = get_option('tmm_twitter');
						$youtube = get_option('tmm_youtube');

						$stories = get_option('tmm_stories');
						?>

						<ul class="social">
							<li class="soc_text"><a href="<?php print $newsletter; ?>">&#9658;
									SIGN UP FOR OUR NEWSLETTER</a></li>
							<?php  if($facebook): ?>
							<li><a class="soc-fb" href="<?php print $facebook; ?>"
								target="_blank"></a></li>
							<?php endif;  ?>
							<?php if($twitter): ?>
							<li><a class="soc-tw" href="<?php print $twitter; ?>"
								target="_blank"></a></li>
							<?php endif;  ?>
							<?php if($youtube): ?>
							<li><a class="soc-yt" href="<?php print $youtube ?>"
								target="_blank"></a></li>
							<?php endif;  ?>
						</ul>
					</div>

					<?php $menu_slug = get_post_meta($post->ID, 'menu', true); ?>
					<div class="menu-main-menu-container" id="mnu_header">
						<ul class="menu" id="menu-main-menu">
							<li class="<?php if($menu_slug == 'get-involved') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-492" id="menu-item-492">
								<a href="<?php echo get_site_url()?>/get-involved/get-involved-1/">Get Involved</a></li>
							<li class="<?php if($menu_slug == 'program-services') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-493" id="menu-item-493">
								<a href="<?php echo get_site_url()?>/program-services/addiction-treatment/counselingcase-management/">Program Services</a></li>
							<li class="<?php if($menu_slug == 'news-events') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-494" id="menu-item-494">
								<a href="<?php echo get_site_url()?>/news-events/press/">News &amp; Events</a></li>
							<li class="<?php if($menu_slug == 'about') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-495" id="menu-item-495">
								<a href="<?php echo get_site_url()?>/about/mission-statement/">About</a></li>
							<li class="<?php if($menu_slug == 'contact') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page lasted menu-item-496" id="menu-item-496">
								<a href="<?php echo get_site_url()?>/contact/info/">Contact</a></li>
						</ul>
					</div>

					<div id="header_button">
						<ul>
							<li class="donate"><a
								href="<?php echo get_option('tmm_e_donate') ?>"></a></li>
							<li class="volunteer"><a
								href="<?php echo get_option('tmm_volunteer') ?>"></a></li>
							<li class="gethelp"><a
								href="<?php echo get_permalink($getHelpPage->ID) ?>"></a></li>
							<li class="stories"><a href="http://themidnightmission.tumblr.com/" target="_blank"></a></li>
						</ul>
					</div>
				</div>
			</header>

			<!-- Main Area -->
			<div id="content" class="group">
				<div id="home-main">
					<?php 
					$page_id = get_the_id('Home Content');
					$page_home = get_page_by_title('Home Content');
					echo $page_home->post_content;
					?>
				</div>
			</div>
			<!-- End Main Area -->
		</div>
		<!--end container-->
	</div>
	<!--Footer Information-->
	
	<?php get_footer(); ?>
</body>
</html>
