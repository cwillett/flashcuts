<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . $css_class;

$projects = explode( ',', $projects );
$uid      = uniqid( 'insight-project-grid-' );
?>

<div class="insight-project-grid project-grid-style <?php echo esc_attr( $el_class ) ?>"
     id="<?php echo esc_attr( $uid ); ?>">
	<?php if ( is_array( $projects ) && ( count( $projects ) > 0 ) ) {
		$params       = array(
			'posts_per_page'      => 24,
			'post_type'           => 'ic_project',
			'ignore_sticky_posts' => 1,
			'post__in'            => $projects,
		);
		$project_loop = new WP_Query( $params );
		if ( $project_loop->have_posts() ) {
			echo '<div class="row">';
			while ( $project_loop->have_posts() ) {
				$project_loop->the_post();
				get_template_part( 'components/content', 'project-grid' );
			}
			echo '</div>';
		}
		wp_reset_postdata();
	} ?>
</div>