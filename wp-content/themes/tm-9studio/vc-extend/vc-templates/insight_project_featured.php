<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
?>
<div class="insight-project-featured <?php echo esc_attr( $el_class ); ?>">
	<?php
	if ( $image ) {
		echo '<div class="image">' . wp_get_attachment_image( $image, 'full' ) . '</div>';
	} else {
		echo '<div class="image">' . get_the_post_thumbnail( $project, 'insight-project-list' ) . '</div>';
	}
	?>
	<div class="info">
		<?php
		$project_categories = wp_get_post_terms( $project, 'ic_project_category', array( "fields" => "all" ) );
		if ( is_array( $project_categories ) && ( count( $project_categories ) > 0 ) ) {
			echo '<div class="category">';
			foreach ( $project_categories as $project_category ) {
				echo '<a href="' . get_term_link( $project_category ) . '">' . esc_html( $project_category->name ) . '</a>';
			}
			echo '</div>';
		}
		echo '<div class="title">' . get_the_title( $project ) . '</div>';
		echo '<div class="more"><a href="' . get_permalink( $project ) . '">' . esc_html__( 'View more', 'tm-9studio' ) . '</a></div>';
		?>
	</div>
</div>