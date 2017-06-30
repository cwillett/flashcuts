<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$info    = (array) vc_param_group_parse_atts( $info );
$socials = (array) vc_param_group_parse_atts( $socials );
?>
<div class="insight-member-info">
	<div class="member-info">
		<?php
		if ( count( $info ) > 0 ) {
			foreach ( $info as $value ) {
				if ( ( $value['name'] != '' ) && ( $value['value'] != '' ) ) {
					echo '<div class="line"><div class="name">' . esc_html( $value['name'] ) . '</div><div class="value">' . esc_html( $value['value'] ) . '</div></div>';
				}
			}
		}
		if ( count( $socials ) > 0 ) {
			echo '<div class="line"><div class="name">' . esc_html__( 'Social', 'tm-9studio' ) . '</div><div class="value socials">';
			foreach ( $socials as $social ) {
				echo '<a href="' . esc_url( $social['link'] ) . '"><i class="' . esc_attr( $social['icon_fontawesome'] ) . '"></i></a>';
			}
			echo '</div></div>';
		}
		?>
	</div>
</div>
