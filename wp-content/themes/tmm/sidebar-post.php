<aside class="left-col">
	<?php
	if(is_nav_menu('news-events-menu')) {
		print wp_nav_menu(array(
				'menu' => 'news-events-menu',
				'container_class' => 'menu-left'
		));
	}
	?>
</aside>
