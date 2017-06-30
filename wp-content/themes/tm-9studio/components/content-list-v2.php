<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-classic-style style-02 blog-list-v2' ); ?>>
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
					<a href="<?php the_permalink(); ?>"><h3 class="rd-font"><?php echo esc_attr( $quote ); ?></h3></a>
				</blockquote>

				<?php Insight_Templates::metadata_standard(); ?>
			</div>
		<?php } else { ?>
			<span class="entry-meta">
				<?php Insight_Templates::posted_on_list(); ?>
			</span>
			<a href="<?php the_permalink(); ?>"><?php the_title( '<h3 class="entry-title rd-font">', '</h3>' ); ?></a>
			<?php Insight_Templates::metadata_standard(); ?>
		<?php } ?>
	<?php } else { ?>
		<div class="row">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="col-md-4">
					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( array( 370, 250 ) ); ?>
						</a>
					</div>
				</div>
			<?php } ?>
			<div class="entry-desc col-md-8">
				<div class="insight-list-categories nd-font">
					<?php echo get_the_category_list( esc_html__( ' ', 'tm-9studio' ) ) ?>
				</div>
				<a href="<?php the_permalink(); ?>"><?php the_title( '<h3 class="entry-title rd-font">', '</h3>' ); ?></a>
				<?php Insight_Templates::metadata_standard(); ?>

				<div class="entry-content">
					<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
				</div>
			</div>
		</div>
	<?php } ?>
</div><!-- #post-## -->
