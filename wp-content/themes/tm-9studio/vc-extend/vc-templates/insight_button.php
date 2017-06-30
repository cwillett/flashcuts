<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' insight-button align-' . $align . ' ' . $style . ' ' . $css_class;

// Get link
$link_html   = '';
$link        = vc_build_link( $link );
$link_url    = ( isset( $link['url'] ) ) ? $link['url'] : '';
$link_text   = ( isset( $link['title'] ) ) ? $link['title'] : '';
$link_target = ( isset( $link['target'] ) && ! empty( $link['target'] ) ) ? $link['target'] : '_self';
$link_rel    = ( isset( $link['rel'] ) ) ? $link['rel'] : '';
?>
<div class="<?php echo esc_attr( $el_class ); ?>">
	<?php
	if ( $style == 'style02' ) {
		$icon_class = isset( ${'icon_' . $icon_lib} ) ? esc_attr( ${'icon_' . $icon_lib} ) : 'ionic';
		echo '<i class="' . esc_attr( $icon_class ) . '"></i>';
	}
	if ( ( $style == 'style03' ) && $image ) {
		echo '<span class="image">' . wp_get_attachment_image( $image, 'full' ) . '</span>';
	}
	?>
	<a href="<?php echo esc_url( $link_url ); ?>"
	   target="<?php echo esc_attr( $link_target ); ?>"
	   rel="<?php echo esc_attr( $link_rel ); ?>"><?php echo esc_html( $link_text ); ?></a>
</div>
