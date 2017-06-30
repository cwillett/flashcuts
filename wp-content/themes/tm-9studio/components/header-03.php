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
				<div class="col-md-12 header-right text-center">
					<div id="open-right" class="open-right">
						<i class="ion-android-menu"></i>
					</div>
				</div>
			</div><!-- /.row -->
		</div>
	</header><!-- /.header -->
<?php } ?>
