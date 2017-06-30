<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
?>
<div class="insight-project-title <?php echo esc_attr( $el_class . ' ' . $style ); ?>">
	<?php
	if ( is_singular( 'ic_project' ) ) {
		?>
		<div class="title">
			<?php
			if ( ( $title == 'custom' ) && ( $custom_title != '' ) ) {
				echo esc_html( $custom_title );
			} else {
				echo get_the_title();
			}
			?>
		</div>
		<?php
		$project_categories = wp_get_post_terms( get_the_ID(), 'ic_project_category', array( "fields" => "all" ) );
		if ( is_array( $project_categories ) && ( count( $project_categories ) > 0 ) ) {
			echo '<div class="category">';
			foreach ( $project_categories as $project_category ) {
				echo '<a href="' . get_term_link( $project_category ) . '">' . esc_html( $project_category->name ) . '</a>';
			}
			echo '</div>';
		}
		Insight_Templates::metadata_standard();
	} else {
		esc_html_e( 'This shortcode just for single project page.', 'tm-9studio' );
	}
	?>
</div>
