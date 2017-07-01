<div <?php post_class( 'project-list-item row row-xs-center' ); ?>>
	<div class="col-md-6 col-thumb">
		<div class="thumb">
			<a href="<?php echo get_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
		</div>
	</div>
	<div class="col-md-6 col-info">
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
			<div class="excerpt">
				<?php echo get_the_excerpt(); ?>
			</div>
			<?php Insight_Templates::metadata_standard(); ?>
		</div>
	</div>
</div><!-- #post-## -->
