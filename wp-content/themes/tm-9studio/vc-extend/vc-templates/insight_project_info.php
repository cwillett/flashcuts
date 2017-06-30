<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$info     = (array) vc_param_group_parse_atts( $info );
?>
	<div class="insight-project-info <?php echo esc_attr( $el_class . ' ' . $style ); ?>">
		<?php
		if ( is_singular( 'ic_project' ) ) {
			if ( count( $info ) > 0 ) {
				foreach ( $info as $item ) {
					?>
					<div class="info-item">
						<div class="info-item-inner">
							<div class="title"><?php echo esc_html( $item['title'] ); ?></div>
							<div class="content"><?php echo esc_html( $item['content'] ); ?></div>
						</div>
					</div>
					<?php
				}
			}
		} else {
			esc_html_e( 'This shortcode just for single project page.', 'tm-9studio' );
		}
		?>
	</div>
<?php if ( $style == 'style02' ) { ?>
	<script>
		jQuery( document ).ready( function( $ ) {
			$( '.insight-project-info.style02' ).slick( {
				infinite: true,
				slidesToShow: <?php echo esc_js( $slides_to_display ); ?>,
				slidesToScroll: <?php echo esc_js( $slides_to_display ); ?>,

				<?php if ( $display_bullets == 'true' ) { ?>
				dots: true,
				<?php } else { ?>
				dots: false,
				<?php } ?>

				<?php if ( $display_arrows == 'true' ) { ?>
				arrows: true,
				<?php } else { ?>
				arrows: false,
				<?php } ?>

				<?php if ( $enable_autoplay == 'true' ) { ?>
				autoplay: true,
				<?php } else { ?>
				autoplay: false,
				<?php } ?>

				responsive: [
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			} );
		} );
	</script>
<?php } ?>