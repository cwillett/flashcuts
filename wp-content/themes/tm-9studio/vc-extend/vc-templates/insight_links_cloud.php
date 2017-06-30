<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

$links_cloud = (array) vc_param_group_parse_atts( $links_cloud );
$id          = uniqid( 'insight-links-cloud' );
?>
<div class="insight-links-cloud <?php echo esc_attr( $el_class ); ?>"
     id="<?php echo esc_attr( $id ); ?>">
	<ul>
		<?php foreach ( $links_cloud as $link_cloud ) { ?>
			<li>
				<a href="<?php echo esc_html( $link_cloud['link'] ); ?>"
				   target="_blank"><?php echo esc_html( $link_cloud['title'] ); ?></a>
			</li>
		<?php } ?>
	</ul>
</div>
