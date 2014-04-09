<aside class="left-col">
	<?php dynamic_sidebar('Primary Sidebar') ?>
	
	<?php 
	$menu_slug = get_post_meta($post->ID, 'menu', true);
	// Get page name
	$pagetitle = get_the_title($post->papost_parent);
	
	// Get page
	$page_e_donate = get_page_by_title('E-Donate');
	$page_donate_goods = get_page_by_title('Donate Goods');
	$page_planned_giving = get_page_by_title('Planned Giving');
	$page_volunteer = get_page_by_title('Volunteer');
	
	//Get link
	$page_e_donate_link = get_permalink($page_e_donate->ID).'step-1/';
	$page_donate_goods_link = get_permalink($page_donate_goods->ID).'step-1/';
	$page_planned_giving_link = get_permalink($page_planned_giving->ID);
	$page_volunteer_link = get_permalink($page_volunteer->ID).'step-1/';
	
	if($menu_slug == 'get-involved') {
	
		$menu_cnt = '<div id="mnu-left-img">';
		if($pagetitle == 'E-Donate 1' || $pagetitle == 'E-Donate 2' || $pagetitle == 'E-Donate 3' || $pagetitle == 'E-Donate 4') {
			$menu_cnt .= '<a class="edonate-down" href="'. get_option('tmm_e_donate') .'"></a>';
			$menu_cnt .= '<a class="donate-goods" href="'. get_option('tmm_donate_goods') .'"></a>';
			$menu_cnt .= '<a class="planned-giving" href="'. $page_planned_giving_link .'"></a>';
			$menu_cnt .= '<a class="volunteer-left" href="'. get_option('tmm_volunteer') .'"></a>';
		} elseif ($pagetitle == 'Donate Goods 1' || $pagetitle == 'Donate Goods 2' || $pagetitle == 'Donate Goods 3') {
			$menu_cnt .= '<a class="edonate" href="'. get_option('tmm_e_donate') .'"></a>';
			$menu_cnt .= '<a class="donate-goods-down" href="'. get_option('tmm_donate_goods') .'"></a>';
			$menu_cnt .= '<a class="planned-giving" href="'. $page_planned_giving_link .'"></a>';
			$menu_cnt .= '<a class="volunteer-left" href="'. get_option('tmm_volunteer') .'"></a>';
		} elseif ($pagetitle == 'Planned Giving') {
			$menu_cnt .= '<a class="edonate" href="'. get_option('tmm_e_donate') .'"></a>';
			$menu_cnt .= '<a class="donate-goods" href="'. get_option('tmm_donate_goods') .'"></a>';
			$menu_cnt .= '<a class="planned-giving-down" href="'. $page_planned_giving_link .'"></a>';
			$menu_cnt .= '<a class="volunteer-left" href="'. get_option('tmm_volunteer') .'"></a>';
		} elseif ($pagetitle == 'Volunteer 1' || $pagetitle == 'Volunteer 2' || $pagetitle == 'Volunteer 3') {
			$menu_cnt .= '<a class="edonate" href="'. get_option('tmm_e_donate') .'"></a>';
			$menu_cnt .= '<a class="donate-goods" href="'. get_option('tmm_donate_goods') .'"></a>';
			$menu_cnt .= '<a class="planned-giving" href="'. $page_planned_giving_link .'"></a>';
			$menu_cnt .= '<a class="volunteer-left-down" href="'. get_option('tmm_volunteer') .'"></a>';
		} else {
			$menu_cnt .= '<a class="edonate" href="'. get_option('tmm_e_donate') .'"></a>';
			$menu_cnt .= '<a class="donate-goods" href="'. get_option('tmm_donate_goods') .'"></a>';
			$menu_cnt .= '<a class="planned-giving" href="'. $page_planned_giving_link .'"></a>';
			$menu_cnt .= '<a class="volunteer-left" href="'. get_option('tmm_volunteer') .'"></a>';
		}
		$menu_cnt .= '</div>';
		echo $menu_cnt;
		if(is_nav_menu($menu_slug. '-menu')) {
			print wp_nav_menu(array(
			'menu' => $menu_slug . '-menu',
			'container_class' => 'menu-left'
			));
		}
	} else {
		if(is_nav_menu($menu_slug. '-menu')) {
			wp_nav_menu(array(
			'menu' => $menu_slug . '-menu',
			'container_class' => 'menu-left'
			));
		}
	}
	?>
	<script>

if($('#menu-program-services-menu').children('li').hasClass('current-menu-item')){
		$('#menu-program-services-menu .current-menu-item').children('.sub-menu').children('li').css({opacity: 0, position: "relative", visibility: "visible"}).animate({opacity: 1}, 100);
	}
	// Hover Menu
	$('.menu-parent-item').hover(
			function () {
				if(!$(this).children('.sub-menu').children('li').hasClass('current-menu-item')){
					$(this).children('.sub-menu').children('li').css({opacity: 0, position: "relative", visibility: "visible"}).animate({opacity: 1}, 400);	
				}
			},
				function () {
					if(!$(this).children('.sub-menu').children('li').hasClass('current-menu-item')){
						$(this).children('.sub-menu').children('li').css({opacity: 0, visibility: "hidden", position: "absolute"});
					}
			}
	);

	</script>
</aside>