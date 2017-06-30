<?php if ( ( Insight::setting( 'header_visibility' ) == 1 ) && ( Insight_Helper::get_post_meta( 'header_visibility' ) != 'hidden' ) ) { ?>
	<header <?php Insight::header_attributes(); ?>>
		<div class="top-search">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
		<div class="header-container">
			<div class="row row-xs-center">
				<div class="col-md-3 header-left">
					<?php Insight::branding_logo(); ?>
				</div>
				<div class="col-md-9 header-right">
					<nav id="menu" class="menu menu--primary">
						<?php Insight::menu_primary() ?>
					</nav>
					<?php if ( Insight::setting( 'header_search_enable' ) == 1 ) { ?>
						<div id="open-search" class="open-search">
							<i class="ion-ios-search-strong"></i>
						</div>
					<?php } ?>
					<?php if ( Insight_Helper::get_post_meta( 'header_special' ) == 'minimal' ) { ?>
						<div id="open-right" class="open-right">
							<i class="ion-android-menu"></i>
						</div>
					<?php } ?>
				</div>
			</div><!-- /.row -->
		</div>
	</header><!-- /.header -->
<?php } ?>
