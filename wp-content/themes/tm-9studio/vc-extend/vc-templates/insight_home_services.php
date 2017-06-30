<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$services = (array) vc_param_group_parse_atts( $services );

$el_class = $this->getExtraClass( $el_class ) . ' align-' . $align . ' color-' . $color;
?>
<div class="insight-home-services <?php echo esc_attr( $el_class ); ?>">
	<div class="icon">
		<?php
		$icon_class = isset( ${'icon_' . $icon_lib} ) ? esc_attr( ${'icon_' . $icon_lib} ) : 'ionic';
		echo '<i class="' . esc_attr( $icon_class ) . '"></i>';
		?>
	</div>
	<div class="title">
		<?php echo esc_html( $title ); ?>
	</div>
	<?php if ( count( $services ) > 0 ) { ?>
		<div class="links">
			<?php
			foreach ( $services as $service ) {
				// Get link
				$link        = vc_build_link( $service['link'] );
				$link_url    = ( isset( $link['url'] ) ) ? $link['url'] : '';
				$link_text   = ( isset( $link['title'] ) ) ? $link['title'] : '';
				$link_target = ( isset( $link['target'] ) && ! empty( $link['target'] ) ) ? $link['target'] : '_self';
				$link_rel    = ( isset( $link['rel'] ) ) ? $link['rel'] : '';
				if ( $link_text != '' ) {
					echo '<a href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '" rel="' . esc_attr( $link_rel ) . '">' . esc_html( $link_text ) . '</a>';
				}
			}
			?>
		</div>
	<?php } ?>
</div>
