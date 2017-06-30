<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'insight-social ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$link_new_page = 'yes';
?>
<?php $social_links_arr = $this->getSocialLinks( $atts ); ?>
<?php if ( ! empty( $social_links_arr ) ) { ?>
	<ul class="<?php echo esc_attr( $css_class ) ?>">
		<?php foreach ( $social_links_arr as $key => $link ) { ?>
			<li class="<?php echo esc_attr( $key ); ?> hint--top hint--bounce hint--success"
			    aria-label="<?php echo ucfirst( esc_attr( $key ) ); ?>">
				<a href="<?php echo esc_url( $link ) ?>"
				   target="<?php echo esc_attr( $link_new_page == 'yes' ? '_blank' : '_self' ); ?>">
					<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
				</a>
			</li>
		<?php } ?>
	</ul>
<?php } ?>
