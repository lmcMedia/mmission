<!DOCTYPE HTML>
<html>
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<link REL="SHORTCUT ICON" href="<?php echo IMAGES?>/midnight_mission.ico" type="image/x-icon" /> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=1100">
<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"
	type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php echo JS ?>/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo JS ?>/sideshow.js"></script>
<script type="text/javascript" src="<?php echo JS ?>/detectbrowser.js"></script>
<?php wp_head(); ?>

</head>

<body>
	<div id="wrap">
		<div id="container" class="group">
			<!--Header - Name of Item Here-->
			<header class="group">
				<div class="header_cnt">
					<h1 class="header_logo">
					
						<a href="<?php echo get_site_url()?>"><img src="<?php print IMAGES ?>/logo.png"
							alt="<?php bloginfo('name'); ?>" /></a>
					</h1>
					<div class="sharing-widget">
						<?php
						//social links
						$facebook = get_option('tmm_facebook');
						$twitter = get_option('tmm_twitter');
						$youtube = get_option('tmm_youtube');
						?>
		
						<ul class="social">
							<li class="soc_text"><a href="<?php print $facebook; ?>">&#9658; SIGN UP FOR OUR
									NEWSLETTER</a></li>
							<?php /* if($facebook): */ ?>
							<li><a href="<?php print $facebook; ?>" target="_blank"><img
									src="<?php echo IMAGES?>/facebook.png" /> </a></li>
							<?php /* endif; */ ?>
							<?php /* if($twitter): */ ?>
							<li><a href="<?php print $twitter; ?>" target="_blank"><img
									src="<?php echo IMAGES?>/twitter.png" /> </a></li>
							<?php /* endif;  */?>
							<?php /* if($youtube): */ ?>
							<li><a href="<?php print $youtube ?>" target="_blank"><img
									src="<?php echo IMAGES?>/youtube.png" /> </a></li>
							<?php /* endif; */ ?>
						</ul>
					</div>
					
					<?php wp_nav_menu( array('menu' => 'main', 'container' => 'div', 'container_id' => 'mnu_header',
											 'depth' => 1 )); ?>
					
					<div id="header_button">
						<ul>
							<li class="donate"><a href="http://69.195.124.119/~midnigt5/staging/donates/GetInvolved%20-%20E%20Donate%20-%20Step%201.htm">Donate Now</a></li>
							<li class="volunteer"><a href="http://69.195.124.119/~midnigt5/staging/donates/GetInvolved%20-%20Volunteer%20-%20Step%201.htm">Volunteer</a></li>
							<li class="gethelp"><a href="#">Get Help</a></li>
							<li class="stories"><a href="#">The Stories</a></li>
						</ul>
					</div>
				</div>
			</header>

			<!-- Main Area -->
			<div id="content" class="group">