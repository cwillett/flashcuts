<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
?>
<div class="insight-project-comment">
	<?php
	if ( is_singular( 'ic_project' ) ) {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		} else {
			esc_html_e( 'Comments are currently closed for this article', 'tm-9studio' );
		}
	} else {
		esc_html_e( 'This shortcode just for single project page.', 'tm-9studio' );
	}
	?>
</div>
