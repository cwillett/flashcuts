<?php
$project_class = 'insight-filter-item project-grid-item col-md-4';
if ( Insight_Helper::get_post_meta( 'featured' ) == 'yes' ) {
	$project_class .= ' insight-filter-item-featured';
}
?>
<div <?php post_class( $project_class ); ?>>
	<div class="project-grid-item-inner">
		<div class="thumb">
			<a href="<?php echo get_permalink(); ?>">
				<?php the_post_thumbnail( 'insight-project-list' ); ?>
			</a>
		</div>
		<div class="info">
			<div class="title">
				<a href="<?php echo get_permalink(); ?>">
					<?php the_title(); ?>
				</a>
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
			?>
			<?php Insight_Templates::metadata_standard( true, false, true ); ?>
		</div>
	</div>
</div><!-- #post-## -->
