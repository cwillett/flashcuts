<?php if ( ( is_active_sidebar( 'footer_01' ) ) || ( is_active_sidebar( 'footer_02' ) ) || ( is_active_sidebar( 'footer_03' ) ) || ( is_active_sidebar( 'footer_04' ) ) ) { ?>
	<footer <?php Insight::footer_attributes(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-4 footer-c1">
					<?php
					Insight::footer_logo();
					if ( is_active_sidebar( 'footer_01' ) ) {
						dynamic_sidebar( 'footer_01' );
					}
					if ( Insight::setting( 'footer_social_enable' ) == 1 ) {
						echo '<div class="footer-social">';
						Insight::social_icons();
						echo '</div>';
					}
					?>
				</div>
				<div class="col-md-2 footer-c2">
					<?php
					if ( is_active_sidebar( 'footer_02' ) ) {
						dynamic_sidebar( 'footer_02' );
					}
					?>
				</div>
				<div class="col-md-2 footer-c3">
					<?php
					if ( is_active_sidebar( 'footer_03' ) ) {
						dynamic_sidebar( 'footer_03' );
					}
					?>
				</div>
				<div class="col-md-4 footer-c4">
					<?php
					if ( is_active_sidebar( 'footer_04' ) ) {
						dynamic_sidebar( 'footer_04' );
					}
					if ( ( Insight::setting( 'footer_gmap_enable' ) == 1 ) && ( Insight::setting( 'footer_gmap_iframe' ) != '' ) ) {
						?>
						<div class="footer-gmap">
							<a href="#" data-featherlight="#gmap"><?php esc_html_e( 'Google Map', 'tm-9studio' ); ?></a>
							<?php echo Insight_Helper::get_gmap_iframe_with_id( 'gmap' ); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div> <!-- /.row -->
		</div><!-- /.wrapper -->
	</footer><!-- /.footer -->
<?php } ?>

