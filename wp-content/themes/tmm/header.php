<!DOCTYPE HTML>
<html>
<head>
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<link REL="SHORTCUT ICON"
	href="<?php echo IMAGES?>/midnight_mission.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"
	type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="<?php echo JS?>/jquery.validate.js" type="text/javascript"></script>
<?php wp_head(); ?>
<?php 
if(is_page('Volunteer 1')){
		echo '<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/start/jquery-ui.css" />';
		echo '<script type="text/javascript" src="'. JS .'/volunteer.js"></script>';
	}

	if(is_page('Donate Goods 2') || is_page('Volunteer 2')){
		echo '<script type="text/javascript" src="'. JS .'/validateDonateGoods.js"></script>';
	}

	if(is_single()){
		echo '<script type="text/javascript" src="'. JS .'/showcomments.js"></script>';
	}


	?>

</head>

<body class="loading">
	<div class="wrap">
		<div id="container" class="group">
		
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
							<li
								class="<?php if($menu_slug == 'get-involved') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-492"
								id="menu-item-492"><a
								href="<?php echo get_site_url()?>/get-involved/get-involved-1/">Get
									Involved</a></li>
							<li
								class="<?php if($menu_slug == 'program-services') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-493"
								id="menu-item-493"><a
								href="<?php echo get_site_url()?>/program-services/addiction-treatment/">Program
									Services</a></li>
							<li
								class="<?php if($menu_slug == 'news-events') echo 'current-menu-item'; ?> menu-item menu-item-type-post_type menu-item-object-page menu-item-494"
								id="menu-item-494"><a
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
				
				
				<?php 
					$pagetitle = get_the_title($post->papost_parent);
	
					// e-donate: 644, 653, 683, 688
					// donate good: 617, 625, 633
					// volunteer:  697, 702, 706
	
					$isDonatePage = false;
					if(in_array(get_the_ID(), array(644, 653, 683, 688, 617, 625, 633)))  {
						$isDonatePage = true;
					}

					$isVolunteerPage = false;
					if(in_array(get_the_ID(), array(697, 702, 706)))  {
						$isVolunteerPage = true;
					}

					// get help : 895
					$isGetHelpPage = false;
					if(get_the_ID() == 895) {
						$isGetHelpPage = true;
					}
						
					$getHelpPage = get_page_by_title('Get Help');
				?>
			
				<div class="header-bottom">
					<div class="container">
						<ul class="header-buttons">
							<li class="donate"><a
							<?php if($isDonatePage) { echo 'class="down" '; }?>
								href="<?php echo get_option('tmm_e_donate') ?>"></a></li>
							<li class="volunteer"><a
							<?php if($isVolunteerPage) { echo 'class="down" '; }?>
								href="<?php echo get_option('tmm_volunteer') ?>"></a></li>
							<li class="get-help"><a
							<?php if($isGetHelpPage) { echo 'class="down" '; }?>
								href="<?php echo get_permalink($getHelpPage->ID) ?>"></a></li>
							<li class="stories"><a
								href="http://themidnightmission.tumblr.com/" target="_blank"></a>
						</ul>
					</div>
				</div>
			</header>
			
			
			<div id="content" class="group">
				<div id="main-bgtop"></div>