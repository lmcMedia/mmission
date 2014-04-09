<!DOCTYPE HTML>
<html>
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<link REL="SHORTCUT ICON"
	href="<?php echo IMAGES?>/midnight_mission.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- 
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
 -->
<!-- <link rel="stylesheet" type="text/css"
	href="<?= CSS ?>/magnific-popup.css" /> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?= CSS ?>/flexslider.css"/>
<link rel="stylesheet" type="text/css" href="<?= CSS ?>/responsive.css" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script
	src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.6/TweenMax.min.js"></script>
<!--<script type="text/javascript"
	src="<?= JS ?>/jquery.magnific-popup.min.js"></script>-->	
<script type="text/javascript" src="<?= JS ?>/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
<script type="text/javascript" src="<?= JS ?>/main.js"></script>

<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

</head>

<body>
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
					
					<a class="logo" href="<?php echo get_site_url()?>"><img
						src="<?= IMAGES ?>/logo.png"
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
						<li class="<?php if($menu_slug == 'get-involved') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-492" id="menu-item-492">
							<a href="<?php echo get_site_url()?>/get-involved/get-involved-1/">Get Involved</a></li>
						<li class="<?php if($menu_slug == 'program-services') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-493" id="menu-item-493">
							<a href="<?php echo get_site_url()?>/program-services/addiction-treatment/counselingcase-management/">Program Services</a></li>
						<li class="<?php if($menu_slug == 'news-events') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-494" id="menu-item-494">
							<a href="<?php echo get_site_url()?>/news-events/press/">News &amp; Events</a></li>
						<li class="<?php if($menu_slug == 'about') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-495" id="menu-item-495">
							<a href="<?php echo get_site_url()?>/about/mission-statement/">About</a>
						<li class="<?php if($menu_slug == 'contact') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page lasted menu-item-496" id="menu-item-496">
							<a href="<?php echo get_site_url()?>/contact/info/">Contact</a></li>
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
			<div class="home-slider">
				<div class="container">
					<div class="flexslider">
						<ul class="slides">
		               	<li>
				    		<img src="<?= IMAGES ?>/home/slider1.jpg">
				    	</li>
				    	<li>
				    		<img src="<?= IMAGES ?>/home/slider2.jpg">
				    	</li>
				    	<li>
				    		<img src="<?= IMAGES ?>/home/slider3.jpg">
				    	</li>
				    	<li>
				    		<img src="<?= IMAGES ?>/home/slider4.jpg">
				    	</li>
				    	<li>
				    		<img src="<?= IMAGES ?>/home/slider5.jpg">
				    	</li>
				    	<li>
				    		<img src="<?= IMAGES ?>/home/slider6.jpg">
				    	</li>
				    	</ul>
					</div>
					<div class="video-container" style="display: block">
						<div class="videoWrapper"  >
							<div id="player"></div>		
						</div>
						<a class="close-video close-video-home"></a>
					</div>
				</div>
			</div>
			
			<div class="container">
				<article>
					<div class="double shadow">
						<div id="tabs" style="display: block; width: 100%; height: 100%;">
							<ul>
								<li><a class="tab-tweets" href="#tabs-1"></a></li>
								<li><a class="tab-facebook" href="#tabs-2"></a></li>
								<li><a class="tab-tumblr" href="#tabs-3"></a></li>
							</ul>
							<div id="tabs-1">
								<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
							</div>
							<div id="tabs-2">
								<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
							</div>
							<div id="tabs-3">
								<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
								<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
							</div>
						</div>
					</div>
					<div class="double-after">
					</div>
					
					<div class="shadow">
						<a target="_blank" href="#">
							<img src="<?= IMAGES ?>/home/box1.jpg" alt="">
						</a>
						<p><a target="_blank" href="#">Learn About Our Mission</a></p>
					</div>
					<div class="shadow">
						<a target="_blank" href="#">
							<img src="<?= IMAGES ?>/home/box2.jpg" alt="">
						</a>
						<p><a target="_blank" href="#">Our Community</a></p>
					</div>
					
					<div class="shadow">
						<a target="_blank" href="#">
							<img src="<?= IMAGES ?>/home/box3.jpg" alt="">
						</a>
						<p><a target="_blank" href="#">The Many Ways You Can Help</a></p>
					</div>
					<div class="shadow">
						<a target="_blank" href="#">
							<img src="<?= IMAGES ?>/home/box4.jpg" alt="">
						</a>
						<p><a target="_blank" href="#">Lorem Ipsum</a></p>
					</div>
					<div class="shadow">
						<a target="_blank" href="#">
							<img src="<?= IMAGES ?>/home/box5.jpg" alt="">
						</a>
						<p><a target="_blank" href="#">Lorem Ipsum</a></p>
					</div>
					<div class="shadow">
						<a target="_blank" href="#">
							<img src="<?= IMAGES ?>/home/box6.jpg" alt="">
						</a>
						<p><a target="_blank" href="#">How to Get Help</a></p>
					</div>
				</article>
			</div>
		</div>
		<a id="startup-video" class="popup-youtube" href="http://www.youtube.com/watch?v=VyQxn8KD6YQ" style="display: none;"></a>
		<?php get_footer(); ?>
	</div>
</body>
</html>
