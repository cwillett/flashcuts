<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

if ( $images == '' ) {
	return;
}

$images = explode( ',', $images );

$uid = uniqid( 'insight-gallery-carousel-' );
?>

<div class="insight-gallery-carousel <?php echo esc_attr( $el_class ) ?>" id="<?php echo esc_attr( $uid ); ?>">
	<?php foreach ( $images as $attach_id ) { ?>
		<div class="insight-gallery-carousel-item">
			<div class="insight-gallery-carousel-item-inner">
				<img src="<?php echo esc_url( Insight_Helper::img_fullsize( $attach_id ) ) ?>" alt=""/>
			</div>
		</div>
	<?php } ?>
</div>

<script>
	jQuery( document ).ready( function( $ ) {
		$( '#<?php echo esc_attr( $uid ); ?>' ).slick( {
			infinite: true,
			centerMode: true,
			variableWidth: true,
			slidesToShow: <?php echo esc_js( $slides_to_display ); ?>,

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
						centerMode: false,
						variableWidth: false,
					}
				}
			]
		} );
	} );
</script>