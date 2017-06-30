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

<div class="insight-project-masonry <?php echo esc_attr( $el_class ) ?>">
	<div class="insight-filter insight-project-filter">
		<ul>
			<?php foreach ( $terms as $key => $term ) { ?>
				<li>
					<a data-filter="<?php echo esc_attr( $term->slug ) ?>">
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
	$loop   = new WP_Query( $params );
	if ( $loop->have_posts() ) {
		$i = 1;
		echo '<div class="insight-filter-items items row">';
		while ( $loop->have_posts() ) {
			$loop->the_post();
			$groups           = wp_get_post_terms( get_the_ID(), 'ic_project_category', array( "fields" => "all" ) );
			$item_group_class = '';
			if ( is_array( $groups ) && ( count( $groups ) > 0 ) ) {
				foreach ( $groups as $group ) {
					$item_group_class .= ' ' . $group->slug;
				}
			}
			switch ( $i ) {
				case 1:
					$item_col_class = 'col-md-5';
					break;
				case 2:
					$item_col_class = 'col-md-7';
					break;
				case 3:
					$item_col_class = 'col-md-4';
					break;
				case 4:
					$item_col_class = 'col-md-4';
					break;
				case 5:
					$item_col_class = 'col-md-4';
					break;
				case 6:
					$item_col_class = 'col-md-7';
					break;
				case 7:
					$item_col_class = 'col-md-5';
					break;
				case 8:
					$item_col_class = 'col-md-4';
					break;
				case 9:
					$item_col_class = 'col-md-4';
					break;
				case 10:
					$item_col_class = 'col-md-4';
					break;
				case 11:
					$item_col_class = 'col-md-5';
					break;
				case 12:
					$item_col_class = 'col-md-7';
					break;
			}
			?>
			<div
				class="insight-filter-item item item-<?php echo esc_attr( $i ); ?> <?php echo esc_attr( $item_col_class . $item_group_class ); ?>">
				<div class="item-inner">
					<div class="thumb">
						<a href="<?php echo get_permalink(); ?>">
							<?php the_post_thumbnail( 'insight-project-list' ); ?>
							<?php Insight_Templates::metadata_standard( true, false, true ); ?>
						</a>
					</div>
					<div class="info">
						<?php
						$project_categories = wp_get_post_terms( get_the_ID(), 'ic_project_category', array( "fields" => "all" ) );
						if ( is_array( $project_categories ) && ( count( $project_categories ) > 0 ) ) {
							echo '<div class="category">';
							foreach ( $project_categories as $project_category ) {
								echo '<a href="' . get_term_link( $project_category ) . '">' . esc_html( $project_category->name ) . '</a>';
							}
							echo '</div>';
						}
						?>
						<div class="title rd-font">
							<a href="<?php echo get_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php
			$i ++;
		}
		wp_reset_postdata();
		echo '</div>';
	}
	?>
</div>
