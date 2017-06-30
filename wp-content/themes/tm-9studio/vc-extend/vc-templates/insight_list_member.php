<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

$members = (array) vc_param_group_parse_atts( $members );
$id      = uniqid( 'insight-list-member-' );
?>

<div class="insight-list-member <?php echo esc_attr( $el_class ); ?>"
     id="<?php echo esc_html( $id ); ?>">
	<?php foreach ( $members as $member ) { ?>
		<div class="item">
			<?php if ( isset( $member['image'] ) && $member['image'] ) { ?>
				<div class="photo"><?php echo wp_get_attachment_image( $member['image'], 'full' ); ?></div>
			<?php } ?>
			<div class="info">
				<span class="name"><?php echo esc_html( $member['name'] ); ?></span>
				<span class="tagline nd-font"><?php echo esc_html( $member['tagline'] ); ?></span>
			</div>
		</div>
	<?php } ?>
</div>
