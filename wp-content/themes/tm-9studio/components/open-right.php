<div id="open-right-content" class="open-right-content">
	<div class="open-right-close"><i class="ion-android-close"></i></div>
	<?php
	if ( has_nav_menu( 'right' ) ) {
		wp_nav_menu( array(
			'menu_id'         => 'right-menu',
			'theme_location'  => 'right',
			'container'       => '',
			'container_class' => '',
			'menu_class'      => 'menu__container'
		) );
	}
	?>
	<div class="search-form">
		<?php get_search_form(); ?>
	</div>
</div>
