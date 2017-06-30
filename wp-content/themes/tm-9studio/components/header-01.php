<?php if ( ( Insight::setting( 'header_visibility' ) == 1 ) && ( Insight_Helper::get_post_meta( 'header_visibility' ) != 'hidden' ) ) { ?>
	<header <?php Insight::header_attributes(); ?>>
		<div class="header-container">
			<div class="row row-xs-center">
				<div class="col-md-3 header-left">
					<?php Insight::branding_logo(); ?>
				</div>
				<div class="col-md-6 header-center">
					<nav id="menu" class="menu menu--primary">
						<?php Insight::menu_primary() ?>
					</nav>
				</div>
				<div class="col-md-3 header-right">
					<?php if ( Insight::setting( 'header_search_enable' ) == 1 ) { ?>
						<div class="header-search">
							<?php get_search_form(); ?>
						</div>
					<?php } ?>
					<?php if ( Insight_Helper::get_post_meta( 'header_special' ) == 'minimal' ) { ?>
						<div id="open-right" class="open-right">
							<i class="ion-ios-search-strong"></i>
						</div>
					<?php } ?>
				</div>
			</div><!-- /.row -->
		</div>
	</header><!-- /.header -->
<?php } ?>
