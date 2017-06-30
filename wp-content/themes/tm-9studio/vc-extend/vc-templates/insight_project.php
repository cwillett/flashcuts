<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class;

?>

<div class="insight-project project-list-style <?php echo esc_attr( $el_class ) ?>">
	<?php
	$params = array(
		'posts_per_page'      => $number,
		'post_type'           => 'ic_project',
		'ignore_sticky_posts' => 1,
		'tax_query'           => array(
			'relation' => 'or',
			array(
				'taxonomy' => 'ic_project_category',
				'field'    => 'slug',
				'terms'    => explode( ',', $categories ),
			)
		),
	);

	if ( get_query_var( 'paged' ) != '' ) {
		$params['paged'] = get_query_var( 'paged' );
	}
	if ( get_query_var( 'page' ) != '' ) {
		$params['paged'] = get_query_var( 'page' );
	}
	$loop = new WP_Query( $params );
	?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php
		get_template_part( 'components/content', 'project-list' );
		?>
	<?php endwhile;
	wp_reset_postdata(); ?>
</div>
