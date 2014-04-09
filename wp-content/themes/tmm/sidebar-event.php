<aside class="left-col">
	<?php 
	$menu_cnt = '<div id="mnu-left-img">';
	$menu_cnt .= '<a class="edonate" href="'. get_option('tmm_e_donate') .'"></a>';
	$menu_cnt .= '<a class="donate-goods" href="'. get_option('tmm_donate_goods') .'"></a>';
	$menu_cnt .= '<a class="planned-giving" href="'. $page_planned_giving_link .'"></a>';
	$menu_cnt .= '<a class="volunteer-left" href="'. get_option('tmm_volunteer') .'"></a>';
	$menu_cnt .= '</div>';
	echo $menu_cnt;
	?>
	
	<?php
	if(is_nav_menu('get-involved-menu')) {
		print wp_nav_menu(array(
				'menu' => 'get-involved-menu',
				'container_class' => 'menu-left'
		));
	}
	?>
</aside>