<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$skills = (array) vc_param_group_parse_atts( $skills );
?>
<div class="insight-member-skill">
	<?php
	if ( $title != '' ) {
		echo '<div class="title">' . str_replace( '/', '<br/>', $title ) . '</div>';
	}
	if ( count( $skills ) > 0 ) {
		echo '<div class="skills">';
		foreach ( $skills as $skill ) {
			if ( ( $skill['name'] != '' ) && ( $skill['value'] != '' ) ) {
				echo '<div class="skill"><div class="name">' . esc_html( $skill['name'] ) . '</div><div class="bar"><div class="line"><div class="line-inner" data-width="' . esc_attr( $skill['value'] ) . '"></div></div><div class="value">' . esc_attr( $skill['value'] ) . '%</div></div></div>';
			}
		}
		echo '</div>';
	}
	?>
</div>
