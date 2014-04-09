<aside class="left-col">
	<?php
	if(is_nav_menu('about-menu')) {
		print wp_nav_menu(array(
				'menu' => 'about-menu',
				'container_class' => 'menu-left'
		));
	}
	?>
</aside>