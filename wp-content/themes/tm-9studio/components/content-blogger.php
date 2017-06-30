<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tm-9studio
 */
global $wp_query;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'col-md-4 blog-grid-style' ); ?>>
	<div class="inner">
		<?php if ( has_post_format( 'quote' ) ) { ?>
			<?php $quote = get_post_meta( $post->ID, '_format_quote_text', true ); ?>
			<?php if ( $quote ) { ?>
				<div class="post-quote">
					<div class="row">
						<div class="col-md-6">
						<span class="entry-meta">
							<?php Insight_Templates::posted_on_list(); ?>
						</span>
						</div>
						<div class="col-md-6 text-right">
							<div class="insight-list-categories nd-font">
								<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
							</div>
						</div>
					</div>
					<blockquote>
						<a href="<?php the_permalink(); ?>"><h5 class="rd-font"><?php echo esc_attr( $quote ); ?></h5>
						</a>
					</blockquote>

					<?php Insight_Templates::metadata_standard( true, true, false ); ?>
				</div>
			<?php } else { ?>
				<span class="entry-meta">
				<?php Insight_Templates::posted_on_list(); ?>
			</span>
				<a href="<?php the_permalink(); ?>"><?php the_title( '<h3 class="entry-title rd-font">', '</h3>' ); ?></a>
				<?php Insight_Templates::metadata_standard( true, true, false ); ?>
			<?php } ?>
		<?php } else { ?>
			<div class="row">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="col-md-12">
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php
								if ( ( $wp_query->current_post + 1 ) % 2 !== 0 ) {
									the_post_thumbnail( 'insight-post-grid' );
								} else {
									the_post_thumbnail( 'insight-gallery-masonry03' ); // insight-post-masonry
								}
								?>
							</a>
							<div class="insight-list-categories nd-font">
								<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="entry-desc col-md-12">
				<span class="entry-meta">
					<?php Insight_Templates::posted_on_list(); ?>
				</span>
					<a href="<?php the_permalink(); ?>"><?php the_title( '<h3 class="entry-title rd-font">', '</h3>' ); ?></a>
					<?php Insight_Templates::metadata_standard( true, true, false ); ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div><!-- #post-## -->
