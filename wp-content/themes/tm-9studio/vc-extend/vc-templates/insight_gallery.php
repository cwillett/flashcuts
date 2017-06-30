<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Get css class
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$el_class  = $this->getExtraClass( $el_class ) . ' ' . $css_class . ' ' . $style;


$categories = explode( ',', $categories );
$terms      = get_terms( 'ic_gallery_category', array(
	'slug' => $categories,
) );

$all_active = 'active';
if ( isset( $categories_default ) && $categories_default != '' ) {
	$all_active = '';
}

?>

<div class="insight-gallery insight-gallery-grid <?php echo esc_attr( $el_class ) ?>">
	<h2 class="display_none"><?php the_title() ?></h2>
	<div class="insight-gallery-filter nd-font">
		<ul data-option-key="filter">
			<li><a class="<?php echo esc_attr( $all_active ) ?>" href="#filter"
			       data-option-value=".insight-gallery-item"><?php esc_html_e( 'All', 'tm-9studio' ) ?></a></li>
			<?php foreach ( $categories as $key => $category ): ?>
				<?php foreach ( $terms as $key => $term ): ?>
					<?php if ( $category != $term->slug ) {
						continue;
					} ?>

					<li><a class="<?php if ( isset( $categories_default ) && $term->slug == $categories_default ) {
							echo esc_attr( 'active' );
						} ?>" href="javascript:;"
					       data-option-value="<?php echo esc_attr( '.' . $term->slug ) ?>"><?php echo esc_html( $term->name ) ?></a>
					</li>

				<?php endforeach; ?>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
	$params = array(
		'posts_per_page'      => $number,
		'post_type'           => 'ic_gallery',
		'ignore_sticky_posts' => 1,
		'tax_query'           => array(
			'relation' => 'or',
			array(
				'taxonomy' => 'ic_gallery_category',
				'field'    => 'slug',
				'terms'    => $categories,
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
	<div class="insight-gallery-images row">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php
			Insight_Helper::$current_index = $loop->current_post;
			get_template_part( 'components/content', $style );
			?>
		<?php endwhile;
		wp_reset_postdata(); ?>
	</div>

	<?php Insight::paging_nav_gallery( $loop ); ?>
</div>
