<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$terms = get_terms( 'ic_project_category', array(
	'slug' => explode( ',', $categories ),
) );

?>

<div class="insight-project-filter project-grid-style <?php echo esc_attr( $el_class ) ?>">
	<div class="insight-filter">
		<ul>
			<?php foreach ( $terms as $key => $term ) { ?>
				<li>
					<a data-filter="ic_project_category-<?php echo esc_attr( $term->slug ) ?>">
						<?php echo esc_html( $term->name ) ?>
					</a>
				</li>
			<?php } ?>
			<li>
				<a class="active" data-filter="insight-all">
					<?php esc_html_e( 'All', 'tm-9studio' ) ?>
				</a>
			</li>
		</ul>
	</div>
	<?php
	$params       = array(
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
	$project_loop = new WP_Query( $params );
	if ( $project_loop->have_posts() ) {
		echo '<div class="insight-filter-items row">';
		while ( $project_loop->have_posts() ) {
			$project_loop->the_post();
			get_template_part( 'components/content', 'project-grid' );
		}
		echo '</div>';
	}
	wp_reset_postdata();
	?>
</div>
