<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

if ( $style ) {
	$el_class .= ' ' . $style;
}

$poster_thumbnail = wp_get_attachment_image_src( $poster, 'full' );
?>
<div class="insight-video <?php echo esc_attr( $el_class ); ?>">
	<?php
	echo '<a href="' . esc_url( $url ) . '" ' . ( $auto_play ? '' : 'data-poster="' . esc_url( $poster_thumbnail[0] ) . '"' ) . '>';
	echo wp_get_attachment_image( $poster, 'full' );
	if ( $time != '' ) {
		echo '<span class="time">' . esc_html( $time ) . '</span>';
	}
	echo '</a>';
	?>
</div>
